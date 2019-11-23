<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CheckRequestQuery
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // If auth guard is default
        if($request->segment(1) !== 'bs-admin' || !$guard) {
            $cookies = ['fra' => null, 'coupon' => null];

            if($request->exists('fra')) {
                $cookies['fra'] = $request->hasCookie('_bsoft_fra') ? $request->cookie('_bsoft_fra') : null;

                if(!$cookies['fra'] || $request->query('fra') != $cookies['fra']) {
                    $cookies['fra'] = Cookie::make('_bsoft_fra', $request->query('fra'), 24 * 60, '/');
                }
            }

            if($request->exists('coupon') || $request->exists('ref')) {
                $coupon = $request->exists('coupon') ? $request->query('coupon') : $request->query('ref');
                $cookies['coupon'] = $request->hasCookie('_bsoft_cpn') ? $request->cookie('_bsoft_cpn') : null;

                if(!$cookies['coupon'] || $coupon != $cookies['coupon']) {
                    $cookies['coupon'] = Cookie::make('_bsoft_cpn', $coupon, 24 * 60, '/');
                }
            }

            $response = $next($request);

            if($cookies['fra'] != null) {
                $response->withCookie($cookies['fra']);
            }
            if($cookies['coupon'] != null) {
                $response->withCookie($cookies['coupon']);
            }
            return $response;
        }

        return $next($request);
    }
}
