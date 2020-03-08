<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TransactionController extends Controller
{
    /**
     * Displays library record.
     * 
     */
    public function record(Request $request)
    {
        $search = $request->get('search');

        $record = DB::table('transactions')
                        ->join ('books', 'transactions.book_id', '=', 'books.id')
                        ->join ('patrons', 'transactions.patron_id', '=', 'patrons.id')
                        ->select ('books.title', 'books.status',
                                'patron.firstname', 'patron.lastname',
                                'transactions.date_issued', 'transactions.date_due', 'transaction.date_returned')                       
                        ->where('patron.lrn', 'LIKE', '%' .$search. '%')
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
