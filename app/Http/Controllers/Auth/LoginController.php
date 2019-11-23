<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/account';
    /**
     * Maximum number of attempts to allow.
     *
     * @var int
     */
    protected $maxAttempts = 3;
    /**
     * Number of minutes to throttle for.
     *
     * @var int
     */
    protected $decayMinutes = 5;


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('query')->only('loginOrRegister');
    }

    /**
     * Show the application's login form.
     *
     * @return Response
     */
    public function showLoginForm()
    {
        return view('theme::auth.login');
    }

    public function loginOrRegister(Request $request) {
        $this->validateRequest($request);

        $client = Client::whereEmail($request->post('email'))
            ->orWhere('mobile', '=', mobileNumberForStore($request->post('email')))
            ->first();

        if($client) {
            return $this->loginClient($request, $client);
        }
        // Not Existing Client
        return $this->registerClient($request);
    }


    protected function loginClient(Request $request, Client $client) {
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($client->active && Hash::check($request->post('password'), $client->password)) {
            $this->guard()->login($client);

            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function registerClient(Request $request) {
        $data = [];

        if(filter_var($request->post('email'), FILTER_VALIDATE_EMAIL)) {
            $data['email'] = $request->post('email');
            $validator = Validator::make($data, [
                'email'      => ['email', 'unique:clients']
            ]);
        }
        else {
            $data['mobile'] = mobileNumberForStore($request->post('email'));
            $validator = Validator::make($data, [
                'mobile'      => ['regex:/^(?:\+880|880|01|1)?(?:\d{11}|\d{13}|\d{10})$/i', 'unique:clients']
            ], [
                'mobile.regex'  => 'Enter valid BD format, eg: 8801234567890 or 01234567890'
            ]);
        }

        if($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->messages());
        }
        $client = new Client();

        $client->email = isset($data['email']) ? $data['email'] : null;
        $client->mobile = isset($data['mobile']) ? $data['mobile'] : null;
        $client->password = Hash::make($request->post('password'));

        $client->save();

        $referral = $this->createReferralCode($client);
        $this->guard()->login($client);

        if($client->email) {
            event(new Registered($client));

            return redirect()->route('verification.notice')->with('resent', true);
        }

        return $this->sendMobileVerification($client);
    }

    /**
     * @param Request $request
     * @return void
     * @throws ValidationException
     */
    protected function validateRequest(Request $request) {
        $this->validate($request, [
            'email'      => ['required', 'string'],
            'password'   => ['required', 'string', 'min:8']
        ]);
    }

    /**
     * @param Client $client
     * @return Coupon
     */
    protected function createReferralCode(Client $client) {
        $coupon = new Coupon();

        $coupon->coupon_code = strtoupper( generateReferralCode() );
        $coupon->coupon_type = 'referral';
        $coupon->coupon_referrer_id = $client->client_id;
        $coupon->coupon_started = Carbon::now()->toDateString();
        $coupon->coupon_discount_amount = 50.00;
        $coupon->coupon_min_order_amount = 100.00;

        $coupon->save();

        return $coupon;
    }

    protected function sendMobileVerification(Client $client) {
        $code = mt_rand(100000, 999999);
        $client->verification_code = Hash::make($code);
        $client->save();

        $client->sendMobileVerificationNotification($code);

        return redirect()->route('verification.notice')->with('mobile', true);
    }
}
