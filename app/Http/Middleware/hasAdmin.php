<?php

namespace App\Http\Middleware;

use App\Providers\AppServiceProvider;
use Closure;
use App\User;

class hasAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(User::where("role","=", "admin")->count() > 0)
            return redirect()->route('login');
        else 
            return $next($request);
    } 
}
