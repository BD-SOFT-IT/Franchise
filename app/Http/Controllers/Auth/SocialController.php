<?php

namespace App\Http\Controllers\Auth;

use App\Models\Client;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Socialite;
use Str;

class SocialController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['web', 'guest']);
    }

    /**
     * Redirect the user to the Provider authentication page.
     *
     * @param $driver
     * @return Response
     */
    public function redirectToProvider($driver) {

        return Socialite::driver($driver)->redirect();
    }

    /**
     * Obtain the user information from Provider.
     *
     * @param $driver
     * @return void
     */
    public function handleProviderCallback($driver) {
        $providedUser = Socialite::driver($driver)->stateless()->user();

        $user = Client::where('provider_id', '=', $providedUser->getId())
            ->first();

        if(!$user) {
            $user = New Client();

            $user->first_name    = Str::before($providedUser->getName(), ' ');
            $user->last_name     = Str::after($providedUser->getName(), ' ');
            $user->provider_id   = $providedUser->getId();
            $user->email         = ($providedUser->getEmail() != null) ? $providedUser->getEmail() : null;
            $user->provider      = $driver;
            $user->img_url       = $providedUser->getAvatar();

            $user->save();

            $referral = $this->createReferralCode($user);

            if($driver == 'google') {
                $user->markEmailAsVerified();
            }
        }
        Auth::login($user);

        if($driver == 'facebook' && $user->email != null) {
            $user->sendEmailVerificationNotification();
        }

        return redirect('/');
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
}
