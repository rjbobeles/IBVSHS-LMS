<?php

namespace App\Http\Controllers;

use App\User;
use App\Patron;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PatronController extends Controller
{
    public function index()
    {
        $patrons = Patron::orderBy('lastname', 'ASC')->orderBy('firstname', 'ASC')->paginate(20);
        return view('librarian.patrons.index')->with('patrons', $patrons);
    }

    public function create()
    {
        return view('librarian.patrons.create');
    }

    public function show($id)
    {
        $patrons = Patron::find($id);
        return view('librarian.patrons.single')->with('patrons', $patrons);
    }

    public function edit($id)
    {
        $patrons = Patron::find($id);
        return view('librarian.patrons.edit')->with('patrons', $patrons);
    }

    public function update(Request $request, $id)
    {
        $patrons = Patron::find($id);
        $validate = $request->validate([
            'role' => ['required', 'in:Student,Teacher'],
            'firstname' => ['required', 'string', 'max:255'],
            'middlename' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('patrons')->ignore($patrons->id)],
            'contactno' => ['required', 'string', 'max:255'],
        ]);

        $patrons = Patron::find($id); 
        $patrons->role = $request->input('role');
        $patrons->firstname = $request->input('firstname');
        $patrons->middlename = $request->input('middlename');
        $patrons->lastname = $request->input('lastname');
        $patrons->contactno = $request->input('contactno');
        $patrons->email = $request->input('email');
        $patrons->save();
        
        return redirect()->route('librarian.patrons.index')->With('success', 'Patron has been successfully updated!');
    }

    public function destroy($id){

        $patrons = Patron::find($id);
        $message = null;
        $action = null;

        if($patrons->deactivated == true)
        {
            $patrons->deactivated = false;
            $patrons->save();
            $message = "Patron has been successfully activated!";
        }
        else 
        {
            $patrons->deactivated = true;
            $patrons->save();
            $message = "Patron has been successfully deactivated!";
        }

        return redirect()->route('librarian.patrons.index')->With('success', $message);
    }

    public function store(Request $request){
        $validate = $request->validate([
            'role' => ['required', 'in:Student,Teacher'],
            'firstname' => ['required', 'string', 'max:255'],
            'middlename' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contactno' => ['required', 'string', 'max:255'],
        ]); 

        $patron = Patron::create([
            'role' => $request->input('role'),
            'firstname' => $request->input('firstname'),
            'middlename' => $request->input('middlename'),
            'lastname' => $request->input('lastname'),
            'contactno' => $request->input('contactno'),
            'email' => $request->input('email'),
            'deactivated' => false,
            'lrn'=> 12341234,
        ]);
        
        $patron->save();
        return redirect()->route('patrons.index')->With('success', 'Patron Added.');

    }
}
