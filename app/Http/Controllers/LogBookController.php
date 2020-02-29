<?php

namespace App\Http\Controllers;

use App\LogBook;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class LogBookController extends Controller
{
    /**
     * Show the view for listing of resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.logs.book.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexData() 
    {
        return Datatables::of(LogBook::select(['id', 'actor_id', 'action', 'book_id', 'title', 'isbn', 'status', 'barcodeno', 'created_at']))
        ->addColumn('issued_by', function($row) { return $row->actor_id . ' | ' . $row->userLogBook->username; })
        ->orderColumn('issued_by', function ($query, $order) {
            $query->orderBy('id', $order);
        })
        ->addColumn('actions', 'admin.logs.book.action')
        ->rawColumns(['link', 'actions'])
        ->make(true);        
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
