<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Support\Facades\Validator;

class CouponsController extends Controller
{
    public function index() {
        $coupons = Coupon::where('coupon_type', '!=', 'referral')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.marketing.coupons.index')
            ->with([
                'coupons'   => $coupons
            ]);
    }

    public function create() {
        return view('admin.marketing.coupons.create');
    }

    public function store(Request $request) {
        $validator = $this->validator($request);
        if($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->messages());
        }

        $coupon = new Coupon();

        $coupon->coupon_code = strtoupper($request->post('coupon_code'));
        $coupon->coupon_type = 'promotional';

        if($request->post('coupon_discount_amount') && $request->post('coupon_discount_amount') > 0) {
            $coupon->coupon_discount_amount = $request->post('coupon_discount_amount');
        }
        else {
            $coupon->coupon_discount_percentage = $request->post('coupon_discount_percentage');
            $coupon->coupon_max_amount = $request->post('max_discount_amount');
        }
        $coupon->coupon_note = $request->post('coupon_note');
        $coupon->coupon_started = Carbon::parse($request->post('coupon_started'))->toDateString();
        $coupon->coupon_expired = Carbon::parse($request->post('coupon_expired'))->toDateString();

        $new_log = [
            'type'          => 'Coupon created',
            'author_id'     => auth('admin')->id(),
            'author_name'   => auth('admin')->user()->name,
            'time'          => Carbon::now()
        ];
        $coupon->coupon_log = makeNewLog($new_log, null, true);

        if(!$coupon->save()) {
            return redirect()->back()->with('status', 'Something went wrong! Please try again later.');
        }
        return redirect()
            ->route('admin.coupon.index')
            ->with('status', 'Coupon successfully created!');
    }

    public function edit($id) {

    }

    public function update(Request $request, $id) {

    }

    public function delete(Request $request) {

    }

    protected function validator(Request $request) {
        $validator = Validator::make($request->all(), [
            'coupon_code'           => ['required', 'string', 'alpha_num', 'min:6', 'max:15', 'unique:coupons'],
            'coupon_note'           => ['nullable', 'string', 'max:512'],
            'coupon_started'        => ['required', 'date'],
            'coupon_expired'        => ['required', 'date']
        ]);

        if($validator->fails()) {
            return $validator;
        }

        if($request->post('coupon_discount_percentage') && $request->post('coupon_discount_percentage') > 0) {
            $validator = Validator::make($request->all(), [
                'max_discount_amount'        => ['required', 'numeric']
            ]);
            if($validator->fails()) {
                return $validator;
            }
        }

        if(!$request->post('coupon_discount_percentage') || $request->post('coupon_discount_percentage') < 0) {
            $validator = Validator::make($request->all(), [
                'coupon_discount_amount'        => ['required', 'numeric']
            ]);
            if($validator->fails()) {
                return $validator;
            }
        }

        if(!$request->post('coupon_discount_amount') || $request->post('coupon_discount_amount') < 0) {
            $validator = Validator::make($request->all(), [
                'coupon_discount_percentage'    => ['required', 'numeric', 'max:99.99']
            ]);
            if($validator->fails()) {
                return $validator;
            }
        }
        return $validator;
    }
}
