<?php

namespace App\Http\Controllers;

use App\LogPatron;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class LogPatronController extends Controller
{
    /**
     * Show the view for listing of resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logPatrons = LogPatron::orderBy('created_at','desc')->paginate(20);
        return view('admin.logs.patron.index')->with('logPatrons',$logPatrons);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexData() 
    {
        return Datatables::of(LogPatron::select(['id', 'actor_id', 'action', 'role', 'patron_id', 'created_at', 'deactivated', 'firstname', 'middlename', 'lastname']))
        ->addColumn('issued_by', function($row) { return $row->actor_id . ' | ' . $row->userLogPatron->username; })
        ->orderColumn('issued_by', function ($query, $order) {
            $query->orderBy('id', $order);
        })
        ->addColumn('name', function($row) { return $row->lastname . ', ' . $row->firstname . ' ' . $row->middlename; })
        ->orderColumn('name', function ($query, $order) {
            $query->orderBy('lastname', $order)->orderBy('firstname', $order)->orderBy('middlename', $order);
        })
        ->editColumn('user_id', function($row) { return $row->user_id . ' | ' . $row->userLogPatron->username; })
        ->editColumn('deactivated', function($row) { 
            if($row->deactivated == 1) return "Deactivated";
            else return "Active";
        })
        ->addColumn('actions', 'admin.logs.patron.action')
        ->rawColumns(['link', 'actions'])
        ->make(true);        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LogPatron  $logPatron
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $logPatron = LogPatron::find($id);
        return view('admin.logs.patron.single')->with('logPatron', $logPatron);
    }
}
