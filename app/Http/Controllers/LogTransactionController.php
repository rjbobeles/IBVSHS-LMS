<?php

namespace App\Http\Controllers;

use App\LogTransaction;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class LogTransactionController extends Controller
{
    /**
     * Show the view for listing of resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logTransactions = LogTransaction::orderBy('created_at','desc')->paginate(20);
        return view('admin.logs.transaction.index')->with('logTransactions', $logTransactions);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexData()
    {
        return Datatables::of(LogTransaction::select(['id', 'actor_id', 'action', 'transaction_id', 'created_at']))
        ->addColumn('issued_by', function($row) { return $row->actor_id . ' | ' . $row->userLogTransaction->username; })
        ->orderColumn('issued_by', function ($query, $order) {
            $query->orderBy('id', $order);
        })
        ->addColumn('actions', 'admin.logs.transaction.action')
        ->rawColumns(['link', 'actions'])
        ->make(true);  
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
        return view('admin.logs.transaction.single')->with('logTransaction', $logTransaction);
    }
}
