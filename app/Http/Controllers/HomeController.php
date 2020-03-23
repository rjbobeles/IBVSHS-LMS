<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth()->User()->role == "Librarian")
            return redirect()->route('librarian');
        else if(Auth()->User()->role == "Admin")
            return redirect()->route('admin');
        else
            return abort(403);
    }

    /**
     * Show the librarian dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function librarian()
    {
        return view('librarian');
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function admin() 
    {
        return view('admin');
    }

    /**
     * Show the patron dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function patron() 
    {
        return view('patron');
    }
}
