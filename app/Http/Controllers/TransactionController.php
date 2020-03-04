<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Book;
use App\LogBook;
use App\User;
use App\Transaction;
use App\DamageReport;


class TransactionController extends Controller
{
    public function create()
    {
        return view('librarian.transactions.create');
    }

    public function fetchPatron(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = DB::table('patrons')->where('lastname', 'LIKE', "%{$query}%")->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:absolute">';
            $sugg_ctr = 0;
            foreach($data as $row)
            {
                $output .= '<li class="p-1"><a href="#" class="p-1" style="text-decoration:none">'.$row->lastname.', '.$row->firstname.' '.$row->middlename.'</a></li>';
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
            $data = DB::table('books')->where('title', 'LIKE', "%{$query}%")->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:absolute">';
            $sugg_ctr = 0;
            foreach($data as $row)
            {
                $output .= '<li class="p-1"><a class="p-1" style="text-decoration:none" href="#">'.$row->title.'</a></li>';
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
            'borrower_name' => ['required'],
            'book' => ['required'],
            'date_issued' => ['required'],
            'date_due' => ['required']
        ]);
        
        $borrower_name = $request->input('borrower_name');
        $brw_name_arr = str_split($borrower_name);
        $lastname_arr = array();

        foreach ($brw_name_arr as $value) {
            if ($value != ',') array_push($lastname_arr, $value);
            else if ($value == ',') break;
        }

        $lastname = implode($lastname_arr);
        $patron_arr = DB::table('patrons')->where('lastname', '=', $lastname)->first(array('id', 'lastname'));

        $book = $request->input('book');
        $input_format_arr = str_split($book);

        if ($input_format_arr[0] == '2') {
            $book_arr = DB::table('books')->where('barcodeno', '=', $book)->first(array('id', 'title'));
        } else {
            $book_arr = DB::table('books')->where('title', '=', $book)->first(array('id', 'title'));
        }
        
        $transactions = new Transaction();
        $transactions->patron_id = $patron_arr->id;
        $transactions->book_id = $book_arr->id;
        $transactions->date_issued = $request->input('date_issued');
        $transactions->date_due = $request->input('date_due');
        $transactions->date_returned = NULL;
        $transactions->save();

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
            'borrower_name' => ['required'],
            'book' => ['required'],
            'date_issued' => ['required'],
            'date_due' => ['required']
        ]);

        $borrower_name = $request->input('borrower_name');
        $brw_name_arr = str_split($borrower_name);
        $lastname_arr = array();

        foreach ($brw_name_arr as $value) {
            if ($value != ',') array_push($lastname_arr, $value);
            else if ($value == ',') break;
        }

        $lastname = implode($lastname_arr);
        $patron_arr = DB::table('patrons')->where('lastname', '=', $lastname)->first(array('id', 'lastname'));

        $book = $request->input('book');
        $input_format_arr = str_split($book);

        if ($input_format_arr[0] == '2') {
            $book_arr = DB::table('books')->where('barcodeno', '=', $book)->first(array('id', 'title'));
        } else {
            $book_arr = DB::table('books')->where('title', '=', $book)->first(array('id', 'title'));
        }

        $transactions = Transaction::find($id);
        $transactions->patron_id = $patron_arr->id;
        $transactions->book_id = $book_arr->id;
        $transactions->date_issued = $request->input('date_issued');
        $transactions->date_due = $request->input('date_due');
        $transactions->date_returned = NULL;
        $transactions->save();
        
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
