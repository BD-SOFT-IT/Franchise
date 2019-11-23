<?php

namespace App\Http\Controllers\Admin\Axios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;


class AdminController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware(['checkSA', 'admin']);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function me() {
        $me = Admin::where('id', '=', auth('admin')->id())
            ->join('admin_roles', 'admins.role_id', '=', 'admin_roles.ar_id')
            ->select(['admins.id', 'admins.first_name', 'admins.last_name', 'admins.name', 'admins.email', 'admins.img_url', 'admins.address', 'admins.city',
                'admins.country', 'admins.postcode', 'admins.mobile_primary', 'admins.mobile_secondary', 'admin_roles.ar_name as admin_role'])
            ->first();


        return response()->json($me, 200);
    }


}
