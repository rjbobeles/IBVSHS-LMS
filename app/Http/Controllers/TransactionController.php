<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Book;
use App\LogBook;
use App\User;
use App\Patron;
use App\Transaction;
use App\LogTransaction;
use App\DamageReport;
use App\Rules\ValidDate;
use Yajra\Datatables\Datatables;

class TransactionController extends Controller
{
    public function index() {
        return view('librarian.transactions.index');
    }

    public function indexData() {
        return DataTables::of(Transaction::select(['id', 'patron_id', 'book_id', 'date_issued', 'date_due', 'date_returned'])->whereNull('date_returned'))
            ->addColumn('patron', function($row) {
                $patron = Patron::find($row->patron_id);
                return $patron->lrn . ' | ' . $patron->lastname . ', ' . $patron->firstname . ' ' . $patron->middlename;
            })
            ->addColumn('book', function($row) {
                $book = Book::find($row->book_id);
                return $book->barcodeno . ' | ' . $book->title;
            })
            ->addColumn('status', function($row) {
                if($row->date_returned == null) return "Not Returned";
                else return "Returned";
            })
            ->addColumn('actions', 'librarian.transactions.action')
            ->rawColumns(['link', 'actions'])
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
            $data = DB::table('patrons')
                    ->where('lastname', 'LIKE', "%{$query}%")
                    ->orWhere('firstname', 'LIKE', "%{$query}%")
                    ->orWhere('lrn', 'LIKE', "%{$query}%")
                    ->orderBy('lastname', 'ASC')
                    ->orderBy('firstname', 'ASC')
                    ->take(6)
                    ->get();
            
            $output = '<ul class="dropdown-menu autocomplete autocomplete-pos">';
            if(count($data) > 0) {
                foreach($data as $row)
                {
                    $output .= '<li class="p-1">' . $row->lastname . ', ' . $row->firstname .', ' . $row->middlename . '</li>';
                }
            } else $output .= '<li class="p-1">NO RESULT FOUND</li>';
            $output .= '</ul>';
            return response()->json($output);
        }
    }

    public function fetchBook(Request $request)
    {
        if($request->get('query'))
        {
            $query_var = $request->get('query');
            $data = DB::table('books')
                    ->where('status', 'available')
                    ->where(function($query) use ($query_var) {
                        $query->where('title', 'LIKE', "%{$query_var}%")->orwhere('barcodeno', 'LIKE', "%{$query_var}%");
                    })
                    ->take(6)
                    ->get(); 

            $output = '<ul class="dropdown-menu autocomplete autocomplete-pos">';
            if(count($data)) {
                foreach($data as $row)
                {
                    $output .= '<li class="p-1"><a class="p-1" style="text-decoration:none;color:black" href="#">' . $row->barcodeno . ' | ' . $row->title.'</a></li>';
                }
            } else $output .= '<li class="p-1">NO RESULT FOUND</li>';
            $output .= '</ul>';
            return response()->json($output);
        }
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'borrower' => ['required'],
            'book' => ['required'],
            'date_due' => ['required', 'after:today', new ValidDate]
        ]);
    
        $borrower = $request->input('borrower');
        $borrower_n = explode(', ', $borrower);
        if(count($borrower_n) <= 1) return redirect()->back()->withError("User not found. Make sure to choose from the suggestions listed below.")->withInput(); 
        if(!defined($borrower_n[2])) $borrower_n[2] = " ";

        if(is_numeric($borrower)) $patron_arr = DB::table('patrons')->where('lrn', '=', $borrower)->first(array('id', 'lastname'));
        else $patron_arr = DB::table('patrons')->where('lastname', '=', $borrower_n[0])->where('firstname', '=', $borrower_n[1])->where('middlename', '=', $borrower_n[2])->first(array('id'));
         
        $book = $request->input('book');
        $book_n = explode(' | ', $book);
        if(count($book_n) <= 1) return redirect()->back()->withError("Book not found. Make sure to choose from the suggestions listed below.")->withInput(); 

        $book_arr = DB::table('books')->where('barcodeno', '=', $book_n[0])->where('title', '=', $book_n[1])->where('status', 'available')->first(array('id'));
        
        if($book_arr == null)  return redirect()->back()->withError("Book not found. Make sure to choose from the suggestions listed below.")->withInput();
        if($patron_arr == null) return redirect()->back()->withError("User not found. Make sure to choose from the suggestions listed below.")->withInput();
            
        $transaction = Transaction::create([
            'patron_id' => $patron_arr->id,
            'book_id' => $book_arr->id,
            'date_issued' => date('o-m-d'),
            'date_due' => $request->input('date_due')
        ]);       

        LogTransaction::create([
            'actor_id' => auth()->user()->id,
            'action' => 'Create Transaction',
            'transaction_id' => $transaction->id,
            'patron_id' => $transaction->patron_id,
            'book_id' => $transaction->book_id,
            'date_issued' => $transaction->date_issued,
            'date_due' => $transaction->date_due,
            'date_returned' => $transaction->date_returned
        ]); 

        $book_id = $book_arr->id;
        $books = Book::find($book_id);
        $books->status = "Borrowed";
        $books->save(); 

        return redirect()->route('transactions.index')->with('success', 'A new transaction has been created!');     
    }

    public function returnBook($id)
    {
        $transactions = Transaction::find($id);

        if($transactions->date_returned != null) return redirect()->route('transactions.index')->with('error', 'The book you selected is currently not being borrwed by anyone!');
        return view('librarian.transactions.returnBook')->with('transactions', $transactions);
    }

    public function returnBookStore(Request $request, $id)
    {
        $validate = $request->validate([
            'condition' => ['required', 'in:Fine,Very Good,Good,Fair,Poor'],
            'status' => ['required', 'in:Available,Reserved,Borrowed,Archived,Missing'],
        ]);
        
        //Update Transactions Table
        $transactions = Transaction::find($id);
        $transactions->date_returned = date('o-m-d');
        $transactions->save();

        //Update Books Table
        $book = Book::find($transactions->book_id);
        $book->condition = $request->input('condition');
        
        $status = $request->input('status');
        if ($status == 'Available') {
            $book->status = "Available";
        } else {
            $book->status = "Missing";
        }
        $book->update();

        if ($request->input('comment') != null || $request->input('comment') != "")
        {
            DamageReport::create([
                'patron_id' => $transactions->patron_id,
                'book_id' => $transactions->book_id,
                'actor_id' => auth()->user()->id,
                'comment' => $request->input('comment')
            ]);
        }

        return redirect()->route('transactions.create')->with('success', 'Book returned successfully!');
    }
}
