<?php

namespace App\Http\Middleware;

use Closure;

class ClientApiAuth
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
        if(!auth()->check()) {
            return response()->json([
                'status' => 'Unauthorized',
                'error'  => 'User is unauthorized!'
            ], 401);
        }

        return $next($request);
    }
}
