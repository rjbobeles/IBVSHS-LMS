<?php

namespace App\Http\Controllers\Auth;

use App\Rules\AlphaSpace;
use App\Rules\ValidPHNumber;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\LogUser;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('hasAdmin');
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname'     => ['required', 'max:50', new AlphaSpace],
            'middlename'    => ['nullable', 'max:50', new AlphaSpace],
            'lastname'      => ['required', 'max:50', new AlphaSpace],
            'username'      => ['required', 'string', 'max:255', 'unique:users'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contactno'     => ['required', 'string', 'max:20', new ValidPHNumber],
            'password'      => ['required', 'string', 'min:8', 'confirmed']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'firstname' => $data['firstname'],
            'middlename' => $data['middlename'],
            'lastname' => $data['lastname'],
            'username' => $data['username'],
            'contactno' => $data['contactno'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'Admin',
            'deactivated' => false
        ]);

        LogUser::create([
            'actor_id' => $user->id,
            'action' => "Create Account",
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
        return $user;
    }
}
