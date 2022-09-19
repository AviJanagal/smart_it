<?php

namespace App\Http\Middleware;

use Closure;
<<<<<<< HEAD
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

=======
use Auth;
>>>>>>> a9c7ca8efae98e41c75d0ee51de56181767fac37
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
<<<<<<< HEAD
    public function handle(Request $request, Closure $next)
    {

        if (Auth::user() &&  Auth::user()->role == "admin") {
            return $next($request);
       }
       return redirect('login')->with('error','You have not admin access');


=======
    public function handle($request, Closure $next)
    {
    if (Auth::user() &&  Auth::user()->role == 'admin') 
        {
             return $next($request);
        }
        else
        {
           return redirect()->route('login');
        }  
>>>>>>> a9c7ca8efae98e41c75d0ee51de56181767fac37
    }
}
