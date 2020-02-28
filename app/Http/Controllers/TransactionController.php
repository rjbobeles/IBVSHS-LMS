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
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $row)
            {
                $output .= '<li><a href="#">'.$row->lastname.'</a></li>';
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
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $row)
            {
                $output .= '<li><a href="#">'.$row->title.'</a></li>';
            }
            $output .= '</ul>';
            return response()->json($output);
        }
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'lastname' => ['required'],
            'book_title' => ['required'],
            'date_issued' => ['required'],
            'date_due' => ['required']
        ]);
        
        $lastname = $request->input('lastname');
        $patron_arr = DB::table('patrons')->where('lastname', '=', $lastname)->first(array('id', 'lastname'));

        $book_title = $request->input('book_title');
        $book_arr = DB::table('books')->where('title', '=', $book_title)->first(array('id', 'title'));

        $transactions = new Transaction();
        $transactions->patron_id = $patron_arr->id;
        $transactions->book_id = $book_arr->id;
        $transactions->date_issued = $request->input('date_issued');
        $transactions->date_due = $request->input('date_due');
        $transactions->date_returned = NULL;
        $transactions->save();

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
            'lastname' => ['required'],
            'book_title' => ['required'],
            'date_issued' => ['required'],
            'date_due' => ['required']
        ]);

        $lastname = $request->input('lastname');
        $patron_arr = DB::table('patrons')->where('lastname', '=', $lastname)->first(array('id', 'lastname'));

        $book_title = $request->input('book_title');
        $book_arr = DB::table('books')->where('title', '=', $book_title)->first(array('id', 'title'));

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
            'date_returned' => ['required']
        ]);

        $transactions = Transaction::find($id);
        $transactions->date_returned = $request->input('date_returned');
        $transactions->save();

        $dmg_report = new DamageReport();
        $dmg_report->patron_id = $request->input('patron_id');
        $dmg_report->book_id = $request->input('book_id');
        $dmg_report->actor_id = auth()->user()->id;
        $dmg_report->comment = $request->input('comment');
        $dmg_report->save();

        return redirect()->route('transactions.create')->with('success', 'Book returned successfully!');
    }
}
