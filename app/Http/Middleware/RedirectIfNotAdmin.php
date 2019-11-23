<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cookie;
use Redirect;
use Session;

class RedirectIfNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {
        if($guard !== 'admin') {
            return Redirect::route('index');
        }

        if (!Auth::guard($guard)->check()) {
            return Redirect::guest('bs-admin/login');
        }

        if (Auth::guard($guard)->check()) {
            $last_activity_cookie = Cookie::make('session_last_activity', time(), 30 * 24 * 60, '/bs-admin');
            Cookie::queue($last_activity_cookie);
        }

        return $next($request);
    }
}
