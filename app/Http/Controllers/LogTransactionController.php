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
        $logTransactions = LogTransaction::all();
        return view('logs.transaction.index')->with('logTransactions', $logTransactions);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LogTransaction  $logTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(LogTransaction $logTransaction)
    {
        $transactionLog = LogTransaction::find($logTransaction);
        return view('logs.transaction.show')->with('transactionLog', $transactionLog);
    }
}
