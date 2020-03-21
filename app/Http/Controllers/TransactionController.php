<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Book;
use App\LogBook;
use App\User;
use App\Transaction;
use App\DamageReport;
use Yajra\Datatables\Datatables;

class TransactionController extends Controller
{
    public function index() {
        return view('librarian.transactions.index');
    }

    public function indexData() {
        return DataTables::of(Transactions::select(['id', 'patron_id', 'book_id', 'date_issued', 'date_due', 'date_returned']))
            ->addColumn('patron', function($row) {
                return $row->patronTransaction->id . ' | ' . $row->$patronTransaction->lastname . ', ' . $row->$patronTransaction->firstname;
            })
            ->addColumn('book', function($row) {
                return $row->bookTransaction->id . ' | ' . $row->$bookTransaction->title;
            })
            ->addColumn('actions', 'librarian.transactions.action')
            ->make(true);
    }

    public function show($id)
    {
        $transaction = Transaction::find($id);
        return view('librarian.transactions.single')->with('transaction', $transaction);
    }

    public function create()
    {
        return view('librarian.transactions.create');
    }

    public function fetchPatron(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = DB::table('patrons')->where('lastname', 'LIKE', "%{$query}%")->orWhere('firstname', 'LIKE', "%{$query}%")->get();
            $output = '<ul class="dropdown-menu autocomplete autocomplete-pos">';
            $sugg_ctr = 0;
            foreach($data as $row)
            {
                $output .= '<li class="p-1"><a href="#" style="text-decoration:none;color:black">'.$row->lastname.', '.$row->firstname.' '.$row->middlename.'</a></li>';
                $sugg_ctr++;
                if ($sugg_ctr == 6)
                    break;
            }
            $output .= '</ul>';
            return response()->json($output);
        }
    }

    public function fetchBook(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = DB::table('books')
                    ->where('title', 'LIKE', "%{$query}%")
                    ->where('status', '!=', 'borrowed')
                    ->where('status', '!=', 'reserved')
                    ->where('status', '!=', 'archived')
                    ->where('status', '!=', 'missing')->get();
            $output = '<ul class="dropdown-menu autocomplete autocomplete-pos">';
            $sugg_ctr = 0;
            foreach($data as $row)
            {
                $output .= '<li class="p-1"><a class="p-1" style="text-decoration:none;color:black" href="#">'.$row->title.'</a></li>';
                $sugg_ctr++;
                if ($sugg_ctr == 6)
                    break;
            }
            $output .= '</ul>';
            return response()->json($output);
        }
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'borrower' => ['required'],
            'book' => ['required'],
            'date_issued' => ['required'],
            'date_due' => ['required']
        ]);
        
        $borrower = $request->input('borrower');
        $brw_arr = str_split($borrower);
        $numbers_arr = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        $lastname_arr = array();
        $temp_firstname_arr = array();
        $firstname_arr = array();
        $space_ctr = 0;
        $comma_ctr = 0;
        $isNum = '';

        foreach ($numbers_arr as $num) {
            if ($num == $brw_arr[0]) {
                $isNum = True;
                break;
            } else {
                $isNum = False;
            }
        }

        if ($isNum == True) {
            $patron_arr = DB::table('patrons')->where('lrn', '=', $borrower)->first(array('id', 'lastname'));
        } else {
            //Get {lastname}
            foreach ($brw_arr as $x) {
                if ($x != ',') {
                    array_push($lastname_arr, $x);
                } else if ($x == ',') {
                    break;
                } 
            }

            //Get {lastname}, {firstname}
            foreach ($brw_arr as $y) {
                if ($y == ' ') {
                    $space_ctr += 1;
                } else if ($space_ctr != 2) {
                    array_push($temp_firstname_arr, $y);
                } else if ($space_ctr == 2) {
                    break;
                }
            }

            //Get {firstname}
            foreach ($temp_firstname_arr as $z) {
                if ($z == ',') {
                    $comma_ctr += 1;
                } else if ($comma_ctr == 1) {
                    array_push($firstname_arr, $z);
                }
            }
            $lastname = implode($lastname_arr);
            $firstname = implode($firstname_arr);
            $patron_arr = DB::table('patrons')->where('lastname', '=', $lastname)->where('firstname', '=', $firstname)->first(array('id', 'lastname'));
        }

        $book = $request->input('book');
        $input_format_arr = str_split($book);

        if ($input_format_arr[0] == '2') {
            $book_arr = DB::table('books')->where('barcodeno', '=', $book)->first(array('id', 'title'));
        } else {
            $book_arr = DB::table('books')->where('title', '=', $book)->first(array('id', 'title'));
        }
        
        try {
            $transactions = new Transaction();
            $transactions->patron_id = $patron_arr->id;
            $transactions->book_id = $book_arr->id;
            $transactions->date_issued = $request->input('date_issued');
            $transactions->date_due = $request->input('date_due');
            $transactions->date_returned = NULL;
            $transactions->save();
        } catch (\ErrorException $exception) {
            return back()->withError("User / Book not found. Make sure to choose from the suggestions given by the dropdown list.")->withInput();
        }

        $book_id = $book_arr->id;
        $books = Book::find($book_id);
        $books->status = "Borrowed";
        $books->update();

        return redirect()->route('transactions.create')->with('success', 'New Transaction Created!');        
    }

    public function edit($id)
    {
        $transactions = Transaction::find($id);
        return view('librarian.transactions.edit')->with('transactions', $transactions);
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'borrower' => ['required'],
            'book' => ['required'],
            'date_issued' => ['required'],
            'date_due' => ['required']
        ]);

        $borrower = $request->input('borrower');
        $brw_arr = str_split($borrower);
        $numbers_arr = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        $lastname_arr = array();
        $temp_firstname_arr = array();
        $firstname_arr = array();
        $space_ctr = 0;
        $comma_ctr = 0;
        $isNum = '';

        foreach ($numbers_arr as $num) {
            if ($num == $brw_arr[0]) {
                $isNum = True;
                break;
            } else {
                $isNum = False;
            }
        }
        
        if ($isNum == True) {
            $patron_arr = DB::table('patrons')->where('lrn', '=', $borrower)->first(array('id', 'lastname'));
        } else {
            //Get {lastname}
            foreach ($brw_arr as $x) {
                if ($x != ',') {
                    array_push($lastname_arr, $x);
                } else if ($x == ',') {
                    break;
                } 
            }

            //Get {lastname}, {firstname}
            foreach ($brw_arr as $y) {
                if ($y == ' ') {
                    $space_ctr += 1;
                } else if ($space_ctr != 2) {
                    array_push($temp_firstname_arr, $y);
                } else if ($space_ctr == 2) {
                    break;
                }
            }

            //Get {firstname}
            foreach ($temp_firstname_arr as $z) {
                if ($z == ',') {
                    $comma_ctr += 1;
                } else if ($comma_ctr == 1) {
                    array_push($firstname_arr, $z);
                }
            }
            $lastname = implode($lastname_arr);
            $firstname = implode($firstname_arr);
            $patron_arr = DB::table('patrons')->where('lastname', '=', $lastname)->where('firstname', '=', $firstname)->first(array('id', 'lastname'));
        }

        $book = $request->input('book');
        $input_format_arr = str_split($book);

        if ($input_format_arr[0] == '2') {
            $book_arr = DB::table('books')->where('barcodeno', '=', $book)->first(array('id', 'title'));
        } else {
            $book_arr = DB::table('books')->where('title', '=', $book)->first(array('id', 'title'));
        }

        try {
            $transactions = Transaction::find($id);
            $transactions->patron_id = $patron_arr->id;
            $transactions->book_id = $book_arr->id;
            $transactions->date_issued = $request->input('date_issued');
            $transactions->date_due = $request->input('date_due');
            $transactions->date_returned = NULL;
            $transactions->save();
        } catch (\ErrorException $exception) {
            return back()->withError("User / Book not found. Make sure to choose from the suggestions given by the dropdown list.")->withInput();
        }
        
        return redirect()->route('transactions.create')->with('success', 'Transaction has been successfully updated!');
    }

    public function returnBook($id)
    {
        $transactions = Transaction::find($id);
        return view('librarian.transactions.returnBook')->with('transactions', $transactions);
    }

    public function returnBookStore(Request $request, $id)
    {
        $validate = $request->validate([
            'date_returned' => ['required'],
            'condition' => ['required'],
            'status' => ['required']
        ]);
        
        //Update Transactions Table
        $transactions = Transaction::find($id);
        $transactions->date_returned = $request->input('date_returned');
        $transactions->save();

        //Update Books Table
        $book_id = $request->input('book_id');
        $book = Book::find($book_id);
        $book->condition = $request->input('condition');
        $status = $request->input('status');
        if ($status == 'Returned') {
            $book->status = "Available";
        } else {
            $book->status = $status;
        }
        $book->update();

        //Insert into Damage Report Table
        $dmg_report = new DamageReport();
        $dmg_report->patron_id = $request->input('patron_id');
        $dmg_report->book_id = $request->input('book_id');
        $dmg_report->actor_id = auth()->user()->id;
        if ($request->input('comment')) {
            $dmg_report->comment = $request->input('comment');
        } else {
            $dmg_report->comment = 'Book has no damages';
        }
        $dmg_report->save();

        return redirect()->route('transactions.create')->with('success', 'Book returned successfully!');
    }
}
