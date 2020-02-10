<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class IsLibrarian
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
        if($request->user() && $request->user()->role != 'Librarian')
        {
            return redirect(RouteServiceProvider::HOME);
            //return new Response(view(‘unauthorized’)->with(‘role’, ‘ADMIN’));
        }

        return $next($request);
    }
}
