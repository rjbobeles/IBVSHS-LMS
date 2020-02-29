<?php

namespace App\Http\Controllers;

use App\LogUser;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class LogUserController extends Controller
{
    /**
     * Show the view for listing of resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logUsers = LogUser::orderBy('created_at','desc')->paginate(20);
        return view('admin.logs.user.index')->with('logUsers', $logUsers);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexData() 
    {
        return Datatables::of(LogUser::select(['id', 'actor_id', 'action', 'user_id', 'created_at']))
        ->addColumn('issued_by', function($row) { return $row->actor_id . ' | ' . $row->userLogUserActor->username; })
        ->orderColumn('issued_by', function ($query, $order) {
            $query->orderBy('id', $order);
        })
        ->editColumn('user_id', function($row) { return $row->user_id . ' | ' . $row->userLogUser->username; })
        ->addColumn('actions', 'admin.logs.user.action')
        ->rawColumns(['link', 'actions'])
        ->make(true);        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LogUser  $logUser
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $logUser = LogUser::find($id);
        return view('admin.logs.user.single')->with('logUser', $logUser);
    }
}
