<?php

namespace App\Http\Controllers\Api;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;

class CouponsController extends Controller
{
    public function validateCoupon(Request $request) {
        $coupon = Coupon::whereCouponCode($request->post('coupon'))
            ->whereDate('coupon_started', '<=', Carbon::now()->toDateString())
            ->first();

        if(!$coupon) {
            return sendNotFoundJsonResponse('Invalid Coupon Code!');
        }
        if($coupon->expired()) {
            return response()->json([
                'code'      => 403,
                'message'   => 'expired',
                'error'     => 'Coupon has been expired!'
            ], 403);
        }

        if($coupon->coupon_min_order_amount && $coupon->coupon_min_order_amount > $request->post('total')) {
            return $this->sendInvalidResponse('Your order total should be minimum "' . $coupon->coupon_min_order_amount . ' BDT"!');
        }

        if(!auth()->check()) {
            return $this->sendValidResponse($coupon);
        }

        if($coupon->coupon_type === 'referral') {
            if($coupon->referrer->client_id === auth()->id()) {
                return $this->sendInvalidResponse('You can\'t use your own referral!');
            }
            if(!$coupon->referrer->hasVerifiedEmail()) {
                return $this->sendInvalidResponse('You referrer hasn\'t yet benn verified!');
            }
        }

        $histories = auth()->user()->couponHistories;
        if(!$histories) {
            return $this->sendValidResponse($coupon);
        }
        foreach($histories as $history) {
            if($coupon->coupon_type === 'referral' && $history->coupon->coupon_type === 'referral') {
                return $this->sendInvalidResponse('You have already used a referral coupon!');
                break;
            }
            if($history->coupon->coupon_code === $coupon->coupon_code) {
                return $this->sendInvalidResponse('You have already used the coupon!');
                break;
            }
        }
        return $this->sendValidResponse($coupon);
    }

    protected function sendValidResponse(Coupon $coupon) {
        $cookie = Cookie::has('_bsoft_cpn') ? Cookie::get('_bsoft_cpn') : null;
        if(!$cookie || $cookie != $coupon->coupon_code) {
            $cookie = Cookie::make('_bsoft_cpn', $coupon->coupon_code, 24 * 60, '/');
        }

        return response()->json([
            'code'          => $coupon->coupon_code,
            'percentage'    => $coupon->coupon_discount_percentage,
            'amount'        => $coupon->coupon_discount_amount,
            'max'           => $coupon->coupon_max_amount
        ], 200)->withCookie($cookie);
    }

    protected function sendInvalidResponse(string $msg) {
        $cookie = Cookie::has('_bsoft_cpn') ? Cookie::get('_bsoft_cpn') : null;
        if($cookie) {
            $cookie = Cookie::make('_bsoft_cpn', '', -60, '/');
        }
        return response()->json([
            'code'      => 403,
            'message'   => 'invalid',
            'error'     => $msg
        ], 403);
    }
}
