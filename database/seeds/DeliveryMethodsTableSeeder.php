<?php

use Illuminate\Database\Seeder;

class DeliveryMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('delivery_methods')->insert([
            'method_name'               => 'Deliver at Door (Standard)',
            'method_charge'             => 60.00,
            'method_available_outside'  => false,
            'method_time'               => '1-2 Working Days',
            'method_note'               => null
        ]);

        DB::table('delivery_methods')->insert([
            'method_name'               => 'Deliver at Door (Priority)',
            'method_charge'             => 100.00,
            'method_available_outside'  => false,
            'method_time'               => '12-24 Hours',
            'method_note'               => null
        ]);

        DB::table('delivery_methods')->insert([
            'method_name'               => 'In-Store Pickup',
            'method_charge'             => 0.00,
            'method_available_outside'  => true,
            'method_time'               => null,
            'method_note'               => null
        ]);

        DB::table('delivery_methods')->insert([
            'method_name'               => 'Sundarbon Courier Service',
            'method_charge'             => 120.00,
            'method_available_outside'  => true,
            'method_time'               => '3-5 Working Days',
            'method_note'               => 'Shipping charge should be paid through bKash in Advance.'
        ]);
    }
}
