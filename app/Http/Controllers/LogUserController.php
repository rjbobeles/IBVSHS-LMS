<?php

namespace App\Http\Controllers;

use App\LogUser;
use Illuminate\Http\Request;

class LogUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logUsers = LogUser::orderBy('created_at','desc')->paginate(20);
        return view('admin.logs.user.index')->with('logUsers', $logUsers);
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
        return view('admin.logs.user.show')->with('logUser', $logUser);
    }
}
