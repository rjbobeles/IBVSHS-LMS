<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class isActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->user() && $request->user()->deactivated == 1)
        {
            Auth::logout();
            return redirect()->to('/')->with('warning', 'Your session has expired because your account has been deactivated.');
        }
        return $next($request);
    }
}
