<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;

class TransactionController extends Controller
{
    /**
     * Displays library record.
     * 
     */
    public function record(Request $request)
    {
        $search = $request->get('search');

        $record = Transaction::join ('books', 'transactions.book_id', '=', 'books.id')
                        ->join ('patrons', 'transactions.patron_id', '=', 'patrons.id')
                        ->select ('books.title', 'books.status',
                                'patrons.firstname', 'patrons.lastname', 'patrons.lrn',
                                'transactions.date_issued', 'transactions.date_due', 'transactions.date_returned')                       
                        ->where('patrons.lrn', 'LIKE', '%' .$search. '%')
                        ->get();

        if (count($record) > 0)
        {
            return view('patron.record')->with('transactions', $record);
        }
        else
        {
            return view('patron.record')->with('transactions', $record)->withMessage('no record');
        }
    }
}