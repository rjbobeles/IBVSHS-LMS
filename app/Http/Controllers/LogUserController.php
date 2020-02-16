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
        $logUsers = LogUser::all();
        return view('logs.user.index')->with('logUsers', $logUsers);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LogUser  $logUser
     * @return \Illuminate\Http\Response
     */
    public function show(LogUser $logUser)
    {
        //return LogUser::find($logUser);
    }
}
