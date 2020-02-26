<?php

namespace App\Http\Controllers;

use App\LogPatron;
use Illuminate\Http\Request;

class LogPatronController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logPatrons = LogPatron::orderBy('created_at','desc')->paginate(20);
        return view('admin.logs.patron.index')->with('logPatrons',$logPatrons);
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
