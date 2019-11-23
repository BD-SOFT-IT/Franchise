<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminRole;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class FranchiseController extends Controller
{
    public function __construct() {
        $this->middleware(['guest']);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function register(Request $request) {
        $this->validate($request, [
            'first_name'        => ['required', 'string', 'max:255'],
            'last_name'         => ['required', 'string', 'max:255'],
            'email'             => ['required', 'email', 'max:191', 'unique:admins'],
            'password'          => ['required', 'string', 'min:8', 'confirmed'],
            'mobile_primary'    => ['required', 'regex:/^(?:\+880|880|01|1)?(?:\d{11}|\d{13}|\d{10})$/i', 'unique:admins'],
            'mobile_secondary'  => ['nullable', 'regex:/^(?:\+880|880|01|1)?(?:\d{11}|\d{13}|\d{10})$/i'],
            'address'           => ['required', 'min:15', 'max:180'],
            'city'              => ['required', 'string']
        ]);

        $role = AdminRole::whereArName('franchise')->first();
        if(!$role) {
            abort(500);
        }
        $franchise = new Admin();

        $franchise->first_name = $request->post('first_name');
        $franchise->last_name = $request->post('last_name');
        $franchise->name = $request->post('first_name') . ' ' . $request->post('last_name');
        $franchise->email = $request->post('email');
        $franchise->password = Hash::make($request->post('password'));
        $franchise->mobile_primary = mobileNumberForStore($request->post('mobile_primary'));
        $franchise->mobile_secondary = $request->post('mobile_secondary') ? mobileNumberForStore($request->post('mobile_secondary')) : null;
        $franchise->address = $request->post('address');
        $franchise->city = $request->post('city');
        $franchise->postcode = $request->post('postcode');
        $franchise->role_id = $role->ar_id;
        $franchise->franchise_id = 'FRA' . mt_rand(100000, 999999);

        if(!$franchise->save()) {
            abort(500);
        }
        return response()->json('ok', 200);
    }
}
