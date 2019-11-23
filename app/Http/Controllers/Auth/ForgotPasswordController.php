<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return Response
     */
    public function showLinkRequestForm()
    {
        return view('theme::auth.passwords.email');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        if(filter_var($request->post('email'), FILTER_VALIDATE_EMAIL)) {
            $this->validateEmail($request);

            $response = $this->broker()->sendResetLink(
                $this->credentials($request)
            );

            return $response == Password::RESET_LINK_SENT
                ? $this->sendResetLinkResponse($request, $response)
                : $this->sendResetLinkFailedResponse($request, $response);
        }

        $validator = Validator::make($request->only('email'), [
            'email'      => ['required', 'regex:/^(?:\+88|01)?(?:\d{11}|\d{13})$/i']
        ], [
            'email.required'  => 'Email or Mobile number is Required!',
            'email.regex'  => 'Enter valid BD format, eg: +8801234567890 or 01234567890'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->messages());
        }

        $mobile = mobileNumberForStore($request->post('email'));

        $client = Client::whereMobile($mobile)
            ->first();

        if(!$client) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'We can\'t find a user with that Mobile Number.']);
        }

        $token = mt_rand(100000, 999999);
        $password = DB::table('client_password_resets')
            ->updateOrInsert(
                [
                    'mobile' => $mobile
                ],
                [
                    'token'         => Hash::make($token),
                    'created_at'    => Carbon::now()->toDateTimeString()
                ]
            );

        $client->sendMobileVerificationNotification($token);

        return redirect()->route('password.reset', ['token' => 'mobile', 'mobile' => $request->post('email')])
            ->with('status', 'We have sent your password reset verification code to your Mobile!');
    }
}
