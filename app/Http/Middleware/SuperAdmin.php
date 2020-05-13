<?php

namespace App\Http\Middleware;

use Closure;
use \Auth;

class SuperAdmin
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
        if (Auth::check() && Auth::user()->rolename == 'SuperAdmin') {
            return $next($request);
        }
        elseif (Auth::check() && Auth::user()->rolename == 'User') {
            return redirect()->route('user');
        }
        elseif (Auth::check() && Auth::user()->rolename == 'Admin') {
            return redirect()->route('admin');
        }
        else {
            return redirect('/');
        }
    }
}
