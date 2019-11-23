<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/account';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:3,1')->only('verify', 'resend');
    }

    /**
     * Show the email verification notice.
     *
     * @param Request $request
     * @return Response
     */
    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('theme::auth.verify');
    }

    public function verifyMobile(Request $request) {
        if ($request->route('id') != $request->user()->getKey()) {
            throw new AuthorizationException;
        }

        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        if (Hash::check($request->post('code'), $request->user()->verification_code)) {
            $request->user()->markEmailAsVerified();
            $client = Client::find($request->user()->getKey());
            $client->verification_code = null;
            $client->save();
        }
        else {
            return redirect()->back()->with('error', 'Wrong Verification Code!');
        }

        return redirect($this->redirectPath())->with('verified', true);
    }

    public function resendMobileVerification(Request $request) {
        $client = Client::find($request->user()->getKey());

        $code = mt_rand(100000, 999999);
        $client->verification_code = Hash::make($code);
        $client->save();

        $client->sendMobileVerificationNotification($code);

        return redirect()->route('verification.notice')->with('mobile', true);
    }
}
