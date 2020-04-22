<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DamageReport;

class CreditsController extends Controller
{

    public function Index() 
    {
        return view('credits'); 
    }

    public function Secret() 
    {

    }
}
