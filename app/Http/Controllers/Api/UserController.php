<?php

namespace App\Http\Controllers\Api;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Image;

class UserController extends Controller
{
    public function user() {
        return Auth::check()
            ? response()->json(auth()->user(), 200)
            : response()->json('Unauthenticated', 200);
    }

    public function clientSettings($key = null, $value = null) {
        if(!$key) {
            return response()->json([
                'vendor'    => request()->cookie('_bsoft_fra'),
                'coupon'    => request()->cookie('_bsoft_cpn'),
                'pView'     => request()->cookie('_bsoft_pView')
            ], 200);
        }
        if(!$value) {
            if(request()->hasCookie('_bsoft_' . $key)) {
                return response()->json([
                    $key    => request()->cookie('_bsoft_' . $key)
                ], 200);
            }
            return response()->json([$key => null], 200);
        }
        $settings = Cookie::make('_bsoft_' . $key, $value, 30 * 24 * 60, '/');

        return response()->json('success', 200)->withCookie($settings);
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'first_name'        => ['required', 'min:2', 'max:35', 'string'],
            'last_name'         => ['required', 'min:2', 'max:35', 'string'],
            'blood'             => ['nullable', 'max:3', 'min:2'],
            'email'             => ['nullable', 'email'],
            'mobile'            => ['required', 'regex:/^(?:\+880|880|01|1)?(?:\d{11}|\d{13}|\d{10})$/i'],
            'mobile_secondary'  => ['nullable', 'regex:/^(?:\+880|880|01|1)?(?:\d{11}|\d{13}|\d{10})$/i']
        ], [
            'mobile.regex'             => 'Enter valid BD format, eg: 8801234567890 or 01234567890',
            'mobile_secondary.regex'   => 'Enter valid BD format, eg: 8801234567890 or 01234567890'
        ]);

        if($validator->fails()) {
            return $this->respondWithValidation($validator);
        }
        if(mobileNumberForStore($request->post('mobile')) !== auth()->user()->mobile) {
            $validator = Validator::make(['mobile' => mobileNumberForStore($request->post('mobile'))], [
                'mobile'            => ['unique:clients']
            ]);
            if($validator->fails()) {
                return $this->respondWithValidation($validator);
            }
        }
        if($request->post('email') !== auth()->user()->email) {
            $validator = Validator::make($request->only('email'), [
                'email'            => ['unique:clients']
            ]);
            if($validator->fails()) {
                return $this->respondWithValidation($validator);
            }
        }

        $client = Client::find(auth()->id());

        if($request->post('image')) {
            $valid_mimes = ['image/png', 'image/jpeg', 'image/webp'];
            $mime = explode(':', substr($request->post('image'), 0, strpos($request->post('image'), ';')))[1];

            if(!in_array($mime, $valid_mimes)) {
                return response()->json([
                    'message'   => 'validation_error',
                    'error'    => 'The file must be a valid Image type'
                ], 422);
            }

            $client->img_url = $this->storeImage($request->post('image'), $request->post('image_name'));
        }

        $client->first_name = $request->post('first_name');
        $client->last_name = $request->post('last_name');
        $client->email = $request->post('email');
        $client->mobile = mobileNumberForStore($request->post('mobile'));
        $client->mobile_secondary = mobileNumberForStore($request->post('mobile_secondary'));
        $client->billing_address = $request->post('address');
        $client->billing_area = $request->post('area');
        $client->billing_city = $request->post('city');
        $client->billing_state = $request->post('state');
        $client->billing_postcode = $request->post('postcode');
        $client->blood_group = $request->post('blood');

        if(!$client->save()) {
            return sendServerErrorJsonResponse();
        }

        return response()->json('success', 200);
    }

    protected function storeImage($dataImage, $originalName) : string {
        $path = public_path('static/uploads/users/avatars');
        $fileName = 'avatar-' . auth()->id() . substr($originalName, strrpos($originalName, '.'));
        $img = Image::make($dataImage)
            ->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($path. '/' . $fileName, 70);

        return 'uploads/users/avatars/' . $fileName;
    }


    protected function respondWithValidation(\Illuminate\Validation\Validator $validator) {
        return response()->json([
            'errors'    => $validator->messages(),
            'status'    => 422
        ], 422);
    }
}
