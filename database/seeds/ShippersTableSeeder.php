<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ShippersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shippers')->insert([
            'shipper_name'      => 'Shanto Rahman',
            'shipper_user_id'   => 5,
            'shipper_company'   => 'SohojBazaar.com',
            'shipper_address'   => 'Bangla Shorok, Rayer Bazaar, Dhaka-1209',
            'shipper_phone'     => '+8801234567890',
            'shipper_email'     => 'shantorahman@gmail.com',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now()
        ]);

        DB::table('shippers')->insert([
            'shipper_name'      => 'Fast Ship',
            'shipper_company'   => 'Fast Ship',
            'shipper_website'   => 'https://www.fastship.com',
            'shipper_address'   => '12/E/8, Bangla Vobon, Kakrail, Dhaka-1209',
            'shipper_phone'     => '+8801234567890',
            'shipper_email'     => 'support@fastship.com',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now()
        ]);

        DB::table('shippers')->insert([
            'shipper_name'      => 'Sundarban Courier Service',
            'shipper_company'   => 'Sundarban Courier Service',
            'shipper_address'   => '12/E/8, Bangla Vobon, Kakrail, Dhaka-1209',
            'shipper_phone'     => '+8801234567890',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now()
        ]);
    }
}
