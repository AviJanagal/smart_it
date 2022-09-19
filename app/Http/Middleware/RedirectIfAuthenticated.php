<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && Auth::user()->role == 'admin') {
            return redirect(RouteServiceProvider::HOME);
        }
        elseif(Auth::guard($guard)->check() && Auth::user()->role == 'employee'){
                return redirect()->route('employee.employee.index');
        }
        else{
            return $next($request);
        }
    }

}
