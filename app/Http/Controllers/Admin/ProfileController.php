<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use DemeterChain\A;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    public function __construct() {
    }

    public function showProfileUpdateForm(){
        return view('admin.profile.update');
    }

    public function profileUpdate(Request $request) {
        if (!$request->post('password') || !Hash::check($request->post('password'), auth('admin')->user()->password)){
            return redirect()->back()
                ->with('error', 'Wrong Password Given');
        }
        $admin = Admin::find(auth('admin')->id());
        if(!$admin) {
            return redirect()->back()
                ->with('error', 'No Profile Found!');
        }

        $validator = Validator::make($request->all(), [
            'first_name'        => ['required', 'string', 'max:55'],
            'last_name'         => ['required', 'string', 'max:55'],
            'address'           => ['nullable', 'string', 'max:180', 'min:15'],
            'city'              => ['nullable', 'string', 'max:55', 'min:4'],
            'postcode'          => ['nullable', 'string', 'max:5', 'min:4'],
            'img_url'           => ['nullable', 'string'],
            'mobile_primary'    => ['required', 'regex:/^(?:\+88|01)?(?:\d{11}|\d{13})$/i'],
            'mobile_secondary'  => ['nullable', 'regex:/^(?:\+88|01)?(?:\d{11}|\d{13})$/i']
        ], [
            'mobile_primary.regex'    => 'Enter valid BD format, eg: +8801234567890 or 01234567890',
            'mobile_secondary.regex'  => 'Enter valid BD format, eg: +8801234567890 or 01234567890',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->messages());
        }
        if(mobileNumber($request->post('mobile_primary')) !== mobileNumber($admin->mobile_primary)) {
            $validator = Validator::make($request->only('mobile_primary'), [
                'mobile_primary'    => ['required', 'unique:admins'],
            ]);
            if($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator->messages());
            }
        }
        if(($admin->isSuperAdmin() || $admin->isAdmin()) && ($request->post('email') !== $admin->email)) {
            $validator = Validator::make($request->only('email'), [
                'email'    => ['required', 'email', 'string', 'unique:admins'],
            ]);
            if($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator->messages());
            }
            $admin->email = $request->post('email');
        }

        $admin->first_name = $request->post('first_name');
        $admin->last_name = $request->post('last_name');
        $admin->name = $request->post('first_name') . ' ' . $request->post('last_name');
        $admin->mobile_primary = $request->post('mobile_primary');
        $admin->mobile_secondary = $request->post('mobile_secondary');
        $admin->address = $request->post('address');
        $admin->city = $request->post('city');
        $admin->postcode = $request->post('postcode');
        $admin->img_url = $request->post('img_url');

        if(!$admin->save()) {
            return redirect()->back()
                ->with('error', 'Something Went Wrong! Please Try Again.');
        }

        return redirect()->back()
            ->with('success', 'Profile Successfully Updated!');


    }

    public function showPasswordChangeForm(){
        return view('admin.profile.account_security');
    }

    public function changePassword(Request $request) {
        $user = Admin::findOrFail(auth('admin')->user()->id);
        $validator = Validator::make($request->all(), [
            'old_password' => [
                'required', 'min:8', function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth('admin')->user()->password)) {
                        $fail('Old Password didn\'t match');
                    }
                },
            ],
            'password'  => ['required', 'string', 'confirmed', 'min:8', function ($attribute, $value, $fail) {
                if (Hash::check($value, auth('admin')->user()->password)) {
                    $fail('Old Password & New Password is same!');
                }
            }]
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user->password = Hash::make($request->post('password'));

        if(!$user->save()) {
            return redirect()->back()->with('error', 'Something went Wrong!');
        }
//        addActivity('admin', $user->id, 'Password Changed.');

        return redirect()->back()->with('success', 'Password Successfully Updated!');
    }
}
