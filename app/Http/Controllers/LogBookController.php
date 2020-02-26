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
        $logBooks = LogBook::orderBy('created_at','desc')->paginate(20);
        return view('admin.logs.book.index')->with('logBooks', $logBooks);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LogBook  $logBook
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $logBook = LogBook::find($id);
        return view('admin.logs.book.single')->with('logBook', $logBook);
    }
}
