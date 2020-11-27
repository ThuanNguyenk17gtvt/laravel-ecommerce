<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class KiemtraAdmin
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
            if (Auth::user()->level==3) {
                return redirect()->intended('/');
            } 
        }
        return $next($request);
    }
}
