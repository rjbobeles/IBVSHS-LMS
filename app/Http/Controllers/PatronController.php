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

class PatronController extends Controller
{
    public function index()
    {
        $patrons = Patron::orderBy('deactivated', 'ASC')->orderBy('lastname', 'ASC')->orderBy('firstname', 'ASC')->paginate(20);

        if(auth()->user()->role == "Librarian") return view('librarian.patrons.index')->with('patrons', $patrons);
        else return view('admin.patrons.index')->with('patrons', $patrons);
    }

    public function create()
    {
        if(auth()->user()->role == "Librarian") return view('librarian.patrons.create');
        else return view('admin.patrons.create');
    }

    public function store(Request $request){
        $validate = $request->validate([
            'role'          => ['required', 'in:Student,Teacher'],
            'firstname'     => ['required', 'string', 'max:50', new AlphaSpace],
            'middlename'    => ['required', 'string', 'max:50', new AlphaSpace],
            'lastname'      => ['required', 'string', 'max:50', new AlphaSpace],
            'contactno'     => ['required', 'string', 'max:16', new ValidPHNumber],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:patrons'],
            'lrn'           => ['required', 'string', 'max:255'],
        ]); 

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

        if(auth()->user()->role == "Librarian") return redirect()->route('librarian.patrons.index')->with('success', 'Patron has been successfully added!');
        else return redirect()->route('admin.patrons.index')->with('success', 'Patron has been successfully added!');
    }

    public function show($id)
    {
        $patron = Patron::find($id);
     
        if(auth()->user()->role == "Librarian") return view('librarian.patrons.single')->with('patron', $patron);
        else return view('admin.patrons.single')->with('patron', $patron);
    }

    public function edit($id)
    {
        $patron = Patron::find($id);
    
        if(auth()->user()->role == "Librarian") return view('librarian.patrons.edit')->with('patron', $patron);
        else return view('admin.patrons.edit')->with('patron', $patron);
    }

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


        if(auth()->user()->role == "Librarian") return redirect()->route('librarian.patrons.index')->With('success', 'Patron has been successfully updated!');
        else return redirect()->route('admin.patrons.index')->With('success', 'Patron has been successfully updated!');
    }

    public function destroy($id){

        $patron = Patron::find($id);
        $message = null;
        $action = null;

        if($patron->deactivated == true)
        {
            $patron->deactivated = false;
            $message = "Patron has been successfully activated!";
        }
        else 
        {
            $patron->deactivated = true;
            $message = "Patron has been successfully deactivated!";
        }
        $patron->save();

        LogPatron::create([
            'actor_id' => auth()->user()->id,
            'action' => $message,
            'patron_id'=> $patron->id,
            'role' => $patron->role,
            'firstname' => $patron->firstname,
            'middlename' => $patron->middlename,
            'lastname' => $patron->lastname,
            'email' => $patron->email,
            'contactno' => $patron->contactno,
            'deactivated' => $patron->deactivated
        ]);

        if(auth()->user()->role == "Librarian") return redirect()->route('librarian.patrons.index')->With('success', $message);
        return redirect()->route('admin.patrons.index')->With('success', 'Patron has been successfully updated!');
    }
}
