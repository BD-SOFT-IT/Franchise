<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            'first_name'    => 'Golam',
            'last_name'     => 'Mostofa',
            'email'         => 'mostofa@gmail.com',
            'password'      => Hash::make('123456'),
            'mobile'        => '+8801234567890',
            'billing_address'=>'109/5, Hatembag Road, East Rayer Bazaar',
            'billing_city'  => 'Dhaka',
            'billing_state' => 'Dhaka',
            'billing_country'=>'Bangladesh',
            'billing_postcode'=>1209,
            'app_api_agent'   => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);

        DB::table('clients')->insert([
            'first_name'    => 'Babul',
            'last_name'     => 'Bhowmik',
            'email'         => 'babul@gmail.com',
            'password'      => Hash::make('123456'),
            'mobile'        => '+8801234567891',
            'billing_address'=>'109/5, Hatembag Road, East Rayer Bazaar',
            'billing_city'  => 'Dhaka',
            'billing_state' => 'Dhaka',
            'billing_country'=>'Bangladesh',
            'app_api_agent'   => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);

        DB::table('clients')->insert([
            'first_name'    => 'Ashpriya',
            'last_name'     => 'Talukder',
            'email'         => 'ashpriya@gmail.com',
            'password'      => Hash::make('123456'),
            'mobile'        => '+8801234567892',
            'billing_address'=>'109/5, Hatembag Road, East Rayer Bazaar',
            'billing_city'  => 'Dhaka',
            'billing_state' => 'Dhaka',
            'billing_country'=>'Bangladesh',
            'app_api_agent'   => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);

        DB::table('clients')->insert([
            'first_name'    => 'Methun',
            'last_name'     => 'Chakroborty',
            'email'         => 'Methun@gmail.com',
            'password'      => Hash::make('123456'),
            'mobile'        => '+8801234567893',
            'billing_address'=>'109/5, Hatembag Road, East Rayer Bazaar',
            'billing_city'  => 'Dhaka',
            'billing_state' => 'Dhaka',
            'billing_country'=>'Bangladesh',
            'app_api_agent'   => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
    }
}
