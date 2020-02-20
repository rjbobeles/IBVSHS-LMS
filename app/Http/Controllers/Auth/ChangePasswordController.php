<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use App\User;
use App\LogUser;
use App\Providers\RouteServiceProvider;

class ChangePasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Change Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password change and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */

    /**
     * Where to redirect users after login.
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
        $this->middleware('auth');
    }

    public function edit()
    {
        return View('auth.passwords.changepassword');
    }

    public function update(Request $request)
    {
        $validate = $request->validate([
            'old-password'  => ['required', new MatchOldPassword],
            'password'      => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $user = User::find(auth()->user()->id);
        $user->password = Hash::make($request->input('password'));
        $user->save();

        LogUser::create([
            'actor_id' => auth()->user()->id,
            'action' => 'Change Password',
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

        return redirect(RouteServiceProvider::HOME)->With('success', 'Password has been changed!');
    }
}
