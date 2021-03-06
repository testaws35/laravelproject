<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\User;
use DB;
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
           //Aruna edited 
            if (Auth::guard($guard)->check()) {

                if($guard == "admin"){
                    //user was authenticated with admin guard.
                    return redirect()->route('admin.home');
                }
                else {
                    return redirect()->route('home');
                }
            }



        return $next($request);
    }
}
