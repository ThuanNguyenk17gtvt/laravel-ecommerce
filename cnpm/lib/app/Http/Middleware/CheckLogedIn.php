<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckLogedIn
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
        if (Auth::check()) {
            if(Auth::user()->level==2 ||Auth::user()->level==1 )
            {
             return redirect()->intended('admin');
            }
            else if (Auth::user()->level==3) {
                return redirect()->intended('/');
            }
        }
        return $next($request);
    }
}
