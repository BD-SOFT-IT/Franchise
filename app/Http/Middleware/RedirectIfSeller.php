<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfSeller
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
        if (Auth::guard('seller')->check()) {
            if($guard === 'seller') {
                return redirect('/seller/login');
//                return redirect('/seller/dashboard');

            }
            return redirect('/seller/dashboard');
        }

        return $next($request);
    }
}
