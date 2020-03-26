<?php

namespace App\Http\Controllers;

use App\User;
use App\LogUser;
use App\Mailer\AppMailer;
use App\Rules\AlphaSpace;
use App\Rules\ValidPHNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{ 
    /**
     * Show the view for listing of resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       return View('admin.users.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexData()
    {
        return Datatables::of(User::select(['id', 'firstname', 'middlename', 'lastname', 'middlename', 'role', 'email', 'deactivated']))
        ->orderColumn('name', function ($query, $order) {
            $query->orderBy('lastname', $order)->orderBy('firstname', $order)->orderBy('middlename', $order);
        })
        ->addColumn('name', function($row) { return $row->lastname . ', ' . $row->firstname . ' ' . $row->middlename; })
        ->editColumn('deactivated', function($row) { 
            if($row->deactivated == 1) return "Deactivated";
            else return "Active";
        })
        ->addColumn('actions', 'admin.users.action')
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
        return View('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'role'          => ['required', 'in:Admin,Librarian'],
            'firstname'     => ['required', 'string', 'max:50', new AlphaSpace],
            'middlename'    => ['required', 'string', 'max:50', new AlphaSpace],
            'lastname'      => ['required', 'string', 'max:50', new AlphaSpace],
            'username'      => ['required', 'string', 'max:255', 'unique:users'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contactno'     => ['required', 'string', 'max:16', new ValidPHNumber],
            'password'      => ['required', 'string', 'min:8', 'confirmed'],
        ]); 

        $user = User::create([
            'firstname' => $request->input('firstname'),
            'middlename' => $request->input('middlename'),
            'lastname' => $request->input('lastname'),
            'username' => $request->input('username'),
            'contactno' => $request->input('contactno'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
            'deactivated' => false
        ]);

        $user->sendEmailVerificationNotification();
        
        LogUser::create([
            'actor_id' => auth()->user()->id,
            'action' => 'Create Account',
            'user_id' => $user->id,
            'firstname' => $user->firstname,
            'middlename' => $user->middlename,
            'lastname' => $user->lastname,
            'username' => $user->username,
            'contactno' => $user->contactno,
            'email' => $user->email,
            'password' => $user->password,
            'role' => $user->role,
            'deactivated' => false
        ]);
        return redirect()->route('users.index')->With('success', 'New user has been added to the system!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return View('admin.users.single')->With('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->id == $id) abort(403);
        
        $user = User::find($id);
        return View('admin.users.edit')->With('user', $user);
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
        $user = User::find($id);
        $validate = $request->validate([
            'role'          => ['required', 'in:Admin,Librarian'],
            'firstname'     => ['required', 'string', 'max:50', new AlphaSpace],
            'middlename'    => ['required', 'string', 'max:50', new AlphaSpace],
            'lastname'      => ['required', 'string', 'max:50', new AlphaSpace],
            'username'      => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email'         => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'contactno'     => ['required', 'string', 'max:16', new ValidPHNumber],
        ]);

        $user = User::find($id); 
        $user->firstname = $request->input('firstname');
        $user->middlename = $request->input('middlename');
        $user->lastname = $request->input('lastname');
        $user->username = $request->input('username');
        $user->contactno = $request->input('contactno');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->save();
        
        LogUser::create([
            'actor_id' => auth()->user()->id,
            'action' => 'Update Account',
            'user_id' => $user->id,
            'firstname' => $user->firstname,
            'middlename' => $user->middlename,
            'lastname' => $user->lastname,
            'username' => $user->username,
            'contactno' => $user->contactno,
            'email' => $user->email,
            'password' => $user->password,
            'role' => $user->role,
            'deactivated' => $user->deactivated
        ]);
        return redirect()->route('users.index')->With('success', 'User has been successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
    public function destroy($id)
    {
        if(auth()->user()->id == $id) abort(403);
    
        $user = User::find($id);
        $message = null;
        $action = null;

        if($user->deactivated == true)
        {
            $user->deactivated = false;
            $message = "User has been successfully activated!";
            $action = "Activate Account";
        }
        else 
        {
            $user->deactivated = true;
            $message = "User has been successfully deactivated!";
            $action = "Deactivate Account";
        }
        $user->save();

        LogUser::create([
            'actor_id' => auth()->user()->id,
            'action' => $action,
            'user_id' => $user->id,
            'firstname' => $user->firstname,
            'middlename' => $user->middlename,
            'lastname' => $user->lastname,
            'username' => $user->username,
            'contactno' => $user->contactno,
            'email' => $user->email,
            'password' => $user->password,
            'role' => $user->role,
            'deactivated' => $user->deactivated
        ]);
        return redirect()->route('users.index')->With('success', $message);
    }
}

