<?php

namespace App\Http\Controllers;

use App\LogTransaction;
use Illuminate\Http\Request;

class LogTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logTransactions = LogTransaction::orderBy('created_at','desc')->paginate(20);
        return view('admin.logs.transaction.index')->with('logTransactions', $logTransactions);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LogTransaction  $logTransaction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $logTransaction = LogTransaction::find($id);
        return view('admin.logs.transaction.show')->with('logTransaction', $logTransaction);
    }
}
