<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coupons')->insert([
            'coupon_code'               => 'BSIT2019',
            'coupon_discount_amount'    => null,
            'coupon_discount_percentage'=> 15.00,
            'coupon_max_amount'         => 100.00,
            'coupon_min_order_amount'   => 350.00,
            'coupon_type'               => 'promotional',
            'coupon_referrer_id'        => null,
            'coupon_started'            => Carbon::parse('2019-07-01')->toDateString(),
            'coupon_expired'            => Carbon::parse('2021-06-30')->toDateString(),
            'coupon_active'             => true,
            'coupon_max_use_time'       => 1000,
            'created_at'                => Carbon::now(),
            'updated_at'                => Carbon::now()
        ]);

        DB::table('coupons')->insert([
            'coupon_code'               => 'REF0123',
            'coupon_discount_amount'    => 50.00,
            'coupon_discount_percentage'=> null,
            'coupon_max_amount'         => null,
            'coupon_min_order_amount'   => 250.00,
            'coupon_type'               => 'referral',
            'coupon_referrer_id'        => 2,
            'coupon_started'            => Carbon::parse('2019-07-01')->toDateString(),
            'coupon_expired'            => null,
            'coupon_active'             => true,
            'coupon_max_use_time'       => 50,
            'created_at'                => Carbon::now(),
            'updated_at'                => Carbon::now()
        ]);

        DB::table('coupons')->insert([
            'coupon_code'               => 'REF1234',
            'coupon_discount_amount'    => 50.00,
            'coupon_discount_percentage'=> null,
            'coupon_max_amount'         => null,
            'coupon_min_order_amount'   => 250.00,
            'coupon_type'               => 'referral',
            'coupon_referrer_id'        => 3,
            'coupon_started'            => Carbon::parse('2019-07-01')->toDateString(),
            'coupon_expired'            => null,
            'coupon_active'             => true,
            'coupon_max_use_time'       => 50,
            'created_at'                => Carbon::now(),
            'updated_at'                => Carbon::now()
        ]);
    }
}
