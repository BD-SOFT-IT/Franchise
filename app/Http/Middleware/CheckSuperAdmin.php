<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\AdminRole;

class CheckSuperAdmin
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
        $route_name = $request->route()->getName();
        $admin_role = AdminRole::where('ar_name', '=', 'super_admin')->first();

        if($admin_role == null) {
            if($route_name != 'admin.setup' && $route_name != 'admin.setup.save') {
                return redirect()->route('admin.setup');
            }
        }
        else {
            $super_admin = $admin_role->admins->first();

            if($super_admin == null && $route_name != 'admin.setup' && $route_name != 'admin.setup.save') {
                return redirect()->route('admin.setup');
            }

            if($super_admin != null) {
                if($route_name == 'admin.setup' || $route_name == 'admin.setup.save') {
                    return redirect()->route('admin.home');
                }
            }
        }

        return $next($request);
    }
}
