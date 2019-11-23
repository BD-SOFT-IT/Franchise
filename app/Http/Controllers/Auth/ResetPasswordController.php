<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
        $this->middleware('guest');
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param Request $request
     * @param  string|null  $token
     * @return Factory|View
     */
    public function showResetForm(Request $request, $token = null)
    {
        if($token === 'mobile') {
            return view('theme::auth.passwords.reset')->with(
                ['token' => $token, 'email' => $request->query('mobile')]
            );
        }
        return view('theme::auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->query('email')]
        );
    }

    public function resetClientPassword(Request $request) {
        if(!$request->exists('mobile')) {
            return $this->reset($request);
        }

        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'regex:/^(?:\+88|01)?(?:\d{11}|\d{13})$/i'],
            'password' => ['required', 'confirmed', 'min:8'],
        ], [
            'email.regex'  => 'Enter valid BD format, eg: +8801234567890 or 01234567890'
        ]);

        $password = DB::table('client_password_resets')
            ->where('mobile', '=', mobileNumberForStore( $request->post('mobile') ) )
            ->first();
        if(!$password) {
            return redirect()->back()->withInput()
                ->with('error', 'Verification Code Not Found for the Requested Mobile Number!');
        }

        if(Carbon::parse($password->created_at)->diffInMinutes(Carbon::now(), false) > 60) {
            return redirect()->back()->withInput()
                ->with('error', 'Verification Code has been Expired!');
        }
        if(!Hash::check($request->post('token'), $password->token)) {
            return redirect()->back()->withInput()
                ->with('error', 'Verification Code Mismatch!');
        }

        $client = Client::whereMobile(mobileNumberForStore($request->post('mobile')))->first();
        $client->password = Hash::make($request->post('password'));
        $client->save();

        DB::table('client_password_resets')
            ->where('mobile', '=', mobileNumberForStore( $request->post('mobile') ) )
            ->delete();

        event(new PasswordReset($client));

        $this->guard()->login($client);

        return redirect($this->redirectPath())
            ->with('status', 'Password successfully changed!');
    }
}
