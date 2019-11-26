<?php

use Illuminate\Database\Seeder;

class SellerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sellers')->insert([
            'type_of_seller'            => 'Business',
            'shop_name'                 => 'Confox',
            'shop_address'              => 'Dhanmondhi',
            'shop_road_number'          => 89,
            'shop_district'             => 'dhaka',
            'shop_url'                  => 'confox.com',
            'shop_identity'             => '987654321',
            'seller_first_name'         => 'Dr',
            'seller_last_name'          => 'Mams',
            'seller_email'              => 'dr@admin.com',
            'seller_password'           => Hash::make('12345678'),
            'seller_number'             => '+8801726472356',
            'seller_alt_number'         => '+8801726472356',
            'seller_terms_conditions'   => 'agree',
            'email_verify_at'           => 'yes',
            'verification_code'         => 'yes',
            'is_active'                 => 0,
            'is_blocked'                => 0,
            'created_at'                => Carbon::now(),
            'updated_at'                => Carbon::now()

        ]);
    }
}
