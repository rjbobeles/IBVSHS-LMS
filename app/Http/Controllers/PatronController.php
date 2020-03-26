<?php

namespace App\Http\Controllers;

use App\User;
use App\Book;
use App\Patron;
use App\Transaction;
use App\LogPatron;
use App\Rules\AlphaSpace;
use App\Rules\ValidPHNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Validator;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class PatronController extends Controller
{
    /**
     * Show the view for listing of resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manage.patrons.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexData()
    {
        return Datatables::of(Patron::select(['id', 'firstname', 'middlename', 'lastname', 'middlename', 'role', 'email', 'deactivated', 'lrn']))
        ->orderColumn('name', function ($query, $order) {
            $query->orderBy('lastname', $order)->orderBy('firstname', $order)->orderBy('middlename', $order);
        })
        ->addColumn('name', function($row) { return $row->lastname . ', ' . $row->firstname . ' ' . $row->middlename; })
        ->editColumn('deactivated', function($row) { 
            if($row->deactivated == 1) return "Deactivated";
            else return "Active";
        })
        ->addColumn('actions', 'manage.patrons.action')
        ->rawColumns(['link', 'actions'])
        ->setRowId(function ($patron) { return $patron->id; })
        ->make(true);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.patrons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){  
        $validator = Validator::make($request->all(), 
        [
            'role'          => ['required', 'in:Student,Teacher'],
            'firstname'     => ['required', 'string', 'max:50', new AlphaSpace],
            'middlename'    => ['required', 'string', 'max:50', new AlphaSpace],
            'lastname'      => ['required', 'string', 'max:50', new AlphaSpace],
            'contactno'     => ['required', 'string', 'max:16', new ValidPHNumber],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:patrons'],
            'lrn'           => ['required', 'numeric', 'unique:patrons']
        ], 
        [
            'lrn.required'  => 'The ID/LRN number is required to continue',
            'lrn.numeric'   => 'The ID/LRN number has to contain only numbers',
            'lrn.unique'    => 'The ID/LRN number has already been taken.',
            'lrn.digits'    => 'The ID/LRN number needs to be :digits digits.'
        ]);

        $validator->sometimes('lrn', 'digits:6', function($input) {
            return $input->role === "Teacher";
        });

        $validator->sometimes('lrn', 'digits:12', function($input) {
            return $input->role === "Student";
        });

        if(!$validator->fails())
        {
            $patron = Patron::create([
                'role' => $request->input('role'),
                'firstname' => $request->input('firstname'),
                'middlename' => $request->input('middlename'),
                'lastname' => $request->input('lastname'),
                'contactno' => $request->input('contactno'),
                'email' => $request->input('email'),
                'deactivated' => false,
                'lrn'=> $request->input('lrn'),
            ]);
            
            LogPatron::create([
                'actor_id' => auth()->user()->id,
                'action' => "Create Patron",
                'patron_id'=> $patron->id,
                'role' => $patron->role,
                'firstname' => $patron->firstname,
                'middlename' => $patron->middlename,
                'lastname' => $patron->lastname,
                'email' => $patron->email,
                'contactno' => $patron->contactno,
                'deactivated' => $patron->deactivated
            ]);

            return redirect()->route('patrons.index')->with('success', 'Patron has been successfully added!');
        } else return redirect()->back()->withErrors($validator)->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patron = Patron::find($id);
        return view('manage.patrons.single')->with('patron', $patron);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patron = Patron::find($id);
    
        return view('manage.patrons.edit')->with('patron', $patron);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $patron = Patron::find($id);
        $validate = $request->validate([
            'firstname'     => ['required', 'string', 'max:50', new AlphaSpace],
            'middlename'    => ['required', 'string', 'max:50', new AlphaSpace],
            'lastname'      => ['required', 'string', 'max:50', new AlphaSpace],
            'email'         => ['required', 'string', 'email', 'max:255', Rule::unique('patrons')->ignore($patron->id)],
            'contactno'     => ['required', 'string', 'max:16', new ValidPHNumber],
        ]);
        
        $patron = Patron::find($id); 
        $patron->firstname = $request->input('firstname');
        $patron->middlename = $request->input('middlename');
        $patron->lastname = $request->input('lastname');
        $patron->contactno = $request->input('contactno');
        $patron->email = $request->input('email');
        $patron->save();
        
        LogPatron::create([
            'actor_id' => auth()->user()->id,
            'action' => "Update Patron",
            'patron_id'=> $patron->id,
            'role' => $patron->role,
            'firstname' => $patron->firstname,
            'middlename' => $patron->middlename,
            'lastname' => $patron->lastname,
            'email' => $patron->email,
            'contactno' => $patron->contactno,
            'deactivated' => $patron->deactivated
        ]);

        return redirect()->route('patrons.index')->With('success', 'Patron has been successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){

        $patron = Patron::find($id);
        $message = null;
        $action = null;

        if($patron->deactivated == true)
        {
            $patron->deactivated = false;
            $action = "Activate Patron";
            $message = "Patron has been successfully activated!";
        }
        else 
        {
            $patron->deactivated = true;
            $action = "Deactivate Patron";
            $message = "Patron has been successfully deactivated!";
        }
        $patron->save();

        LogPatron::create([
            'actor_id' => auth()->user()->id,
            'action' => $action,
            'patron_id'=> $patron->id,
            'role' => $patron->role,
            'firstname' => $patron->firstname,
            'middlename' => $patron->middlename,
            'lastname' => $patron->lastname,
            'email' => $patron->email,
            'contactno' => $patron->contactno,
            'deactivated' => $patron->deactivated
        ]);

        return redirect()->route('patrons.index')->With('success', $message);
    }

    public function Records(Request $request) {
            $records = NULL;
            return view('patron.booksRecord')->with('records', $records);
    }

    
    public function ViewRecords(Request $request) {
        $validate = $request->validate([
            'lastName' => ['required'],
            'firstName' => ['required'],
            'email' => ['required']
        ]);

        $lastName = $request->input('lastName');
        $firstName = $request->input('firstName');
        $email = $request->input('email');

        try {
            $patron = DB::table('patrons')
                    ->where('lastname', '=', $lastName)
                    ->where('firstname', '=', $firstName)
                    ->where('email', '=', $email)->first();

            $records = Transaction::where('patron_id', '=', $patron->id)->get();
            $recordsName = Transaction::where('patron_id', '=', $patron->id)->first();
        } catch (\ErrorException $exception) {
            return back()->withError("You have no transaction records.")->withInput();
        }            
        
        return view('patron.booksRecord')->with('records', $records)->with('recordsName', $recordsName);
    }
    
}
