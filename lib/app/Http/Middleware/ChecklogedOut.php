<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Alert;

class ChecklogedOut
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
        if (Auth::guest()) {
            // alert()->info('Bạn','Cần đăng nhập để mua hàng');
            return redirect()->intended('login');
        }
        return $next($request);
    }
}
