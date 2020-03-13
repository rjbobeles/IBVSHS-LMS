<?php

namespace App\Http\Controllers;

use App\User;
use App\Patron;
use App\LogPatron;
use App\Rules\AlphaSpace;
use App\Rules\ValidPHNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Yajra\Datatables\Datatables;

class PatronController extends Controller
{
    /**
     * Show the view for listing of resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->role == "Librarian") return view('librarian.patrons.index');
        else return view('admin.patrons.index');
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
        ->addColumn('actions', 'librarian.patrons.action')
        ->rawColumns(['link', 'actions'])
        ->setRowId(function ($user) { return $user->id; })
        ->make(true);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexDataAdmin()
    {
        return Datatables::of(Patron::select(['id', 'firstname', 'middlename', 'lastname', 'middlename', 'role', 'email', 'deactivated']))
        ->orderColumn('name', function ($query, $order) {
            $query->orderBy('lastname', $order)->orderBy('firstname', $order)->orderBy('middlename', $order);
        })
        ->addColumn('name', function($row) { return $row->lastname . ', ' . $row->firstname . ' ' . $row->middlename; })
        ->editColumn('deactivated', function($row) { 
            if($row->deactivated == 1) return "Deactivated";
            else return "Active";
        })
        ->addColumn('actions', 'admin.patrons.action')
        ->rawColumns(['link', 'actions'])
        ->setRowId(function ($user) { return $user->id; })
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->role == "Librarian") return view('librarian.patrons.create');
        else return view('admin.patrons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validate = $request->validate([
            'role'          => ['required', 'in:Student,Teacher'],
            'firstname'     => ['required', 'string', 'max:50', new AlphaSpace],
            'middlename'    => ['required', 'string', 'max:50', new AlphaSpace],
            'lastname'      => ['required', 'string', 'max:50', new AlphaSpace],
            'contactno'     => ['required', 'string', 'max:16', new ValidPHNumber],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:patrons'],
        ]); 

        $validate = sometimes('lrn', 'required|numeric|max:12', function($input) {
            return $input->lrn == "Student";
        });

        $validate = sometimes('lrn', 'required|numeric|max:6', function($input) {
            return $input->lrn == "Teacher";
        });

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

        if(auth()->user()->role == "Librarian") return redirect()->route('patrons.index')->with('success', 'Patron has been successfully added!');
        else return redirect()->route('admin.patrons.index')->with('success', 'Patron has been successfully added!');
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
     
        if(auth()->user()->role == "Librarian") return view('librarian.patrons.single')->with('patron', $patron);
        else return view('admin.patrons.single')->with('patron', $patron);
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
    
        if(auth()->user()->role == "Librarian") return view('librarian.patrons.edit')->with('patron', $patron);
        else return view('admin.patrons.edit')->with('patron', $patron);
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
            'role'          => ['required', 'in:Student,Teacher'],
            'firstname'     => ['required', 'string', 'max:50', new AlphaSpace],
            'middlename'    => ['required', 'string', 'max:50', new AlphaSpace],
            'lastname'      => ['required', 'string', 'max:50', new AlphaSpace],
            'email'         => ['required', 'string', 'email', 'max:255', Rule::unique('patrons')->ignore($patron->id)],
            'contactno'     => ['required', 'string', 'max:16', new ValidPHNumber],
            
        ]);

        $patron = Patron::find($id); 
        $patron->role = $request->input('role');
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


        if(auth()->user()->role == "Librarian") return redirect()->route('patrons.index')->With('success', 'Patron has been successfully updated!');
        else return redirect()->route('admin.patrons.index')->With('success', 'Patron has been successfully updated!');
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

        if(auth()->user()->role == "Librarian") return redirect()->route('patrons.index')->With('success', $message);
        return redirect()->route('admin.patrons.index')->With('success', 'Patron has been successfully updated!');
    }
}
