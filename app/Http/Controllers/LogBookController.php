<?php

namespace App\Http\Controllers;

use App\LogBook;
use Illuminate\Http\Request;

class LogBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logBooks = LogBook::all();
        return view('logs.book.index')->with('logBooks', $logBooks);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LogBook  $logBook
     * @return \Illuminate\Http\Response
     */
    public function show(LogBook $logBook)
    {
        //return LogBook::find($logBook);
    }
}
