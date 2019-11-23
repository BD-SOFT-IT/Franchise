<?php

namespace App\Http\Middleware;

use App\Models\ApiAgent;
use Closure;
use Illuminate\Http\Request;

class CheckAgent
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $agent = ApiAgent::where('agent_api_key', '=', $request->header('RBT-API-KEY'))
            ->where('agent_api_secret', '=', $request->header('RBT-API-SECRET'))
            ->first();

        if(!$agent) {
            return response()->json('API key or secret not matched..!', 200);
        }
        return $next($request);
    }
}
