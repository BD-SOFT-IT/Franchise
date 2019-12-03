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
            'type_of_seller'            => 'Personal',
            'shop_name'                 => 'Confox',
            'shop_address'              => 'Dhanmondhi',
            'shop_road_number'          => 89,
            'shop_district'             => 'dhaka',
            'shop_url'                  => 'confox.com',
            'shop_identity'             => '987654321',
            'seller_first_name'         => 'Drrrrrr',
            'seller_last_name'          => 'Mamsssss',
            'seller_email'              => 'dr@admin.com',
            'seller_password'           => Hash::make('12345678'),
            'seller_number'             => '01726472356',
            'seller_alt_number'         => '01726472356',
            'seller_terms_conditions'   => 'agree',
            'email_verify_at'           => 'yes',
            'verification_code'         => 'yes',
            'is_active'                 => 1,
            'is_blocked'                => 1,
            'created_at'                => Carbon::now(),
            'updated_at'                => Carbon::now()

        ]);
    }
}
