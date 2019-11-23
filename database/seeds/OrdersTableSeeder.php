<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $log = makeNewLog([
            'type'          => 'Created',
            'author_type'   => 'client',
            'author_id'     => 1,
            'author_name'   => 'Client Name',
            'time'          => Carbon::now()
        ], null, true);

        DB::table('orders')->insert([
            'order_no'              => '1806190001',
            'order_client_id'       => 1,
            'order_products_total'  => 1734.50,
            'order_total'           => 1734.50,
            'order_total_due'       => 0.00,
            'order_shipping_method' => 1,
            'order_shipper_id'      => 3,
            'order_shipping_person' => 'Golam Moni',
            'order_shipping_phone'  => '+8801234567890',
            'order_shipping_address'=> '109/5, Hatembag Road, East Rayer Bazaar',
            'order_shipping_area'   => 'Dhaka',
            'order_shipping_city'   => 'Dhaka',
            'order_shipping_state'  => 'Dhaka',
            'order_shipping_country'=> 'Bangladesh',
            'order_shipping_postcode'=> 1209,
            'order_payment_type'    => 'Debit Card',
            'order_payment_status'  => 'Paid',
            'order_progress'        => 'delivered',
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);

        DB::table('orders')->insert([
            'order_no'              => '1806190002',
            'order_client_id'       => 2,
            'order_products_total'  => 1734.50,
            'order_total'           => 1734.50,
            'order_total_due'       => 1734.50,
            'order_shipping_method' => 1,
            'order_shipping_person' => 'John Jonson',
            'order_shipping_phone'  => '+8801234567890',
            'order_shipping_address'=> '109/5, Hatembag Road, East Rayer Bazaar',
            'order_shipping_area'   => 'Dhaka',
            'order_shipping_city'   => 'Dhaka',
            'order_shipping_state'  => 'Dhaka',
            'order_shipping_country'=> 'Bangladesh',
            'order_shipping_postcode'=> 1209,
            'order_payment_type'    => 'Cash on Delivery',
            'order_payment_status'  => 'Due',
            'order_progress'        => 'canceled',
            'order_log'             => $log,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);

        DB::table('orders')->insert([
            'order_no'              => '1806190003',
            'order_client_id'       => 3,
            'order_products_total'  => 1734.50,
            'order_total'           => 1734.50,
            'order_total_due'       => 0.00,
            'order_shipping_method' => 1,
            'order_shipping_person' => 'John Jonson',
            'order_shipping_phone'  => '+8801234567890',
            'order_shipping_address'=> '48/A, Sukrabad, Dhanmondi',
            'order_shipping_area'   => 'Dhaka',
            'order_shipping_city'   => 'Dhaka',
            'order_shipping_state'  => 'Dhaka',
            'order_shipping_country'=> 'Bangladesh',
            'order_shipping_postcode'=> 1207,
            'order_payment_type'    => 'bKash',
            'order_payment_status'  => 'Paid',
            'order_progress'        => 'processing',
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);

        DB::table('orders')->insert([
            'order_no'              => '1806190004',
            'order_client_id'       => 4,
            'order_products_total'  => 1734.50,
            'order_total'           => 1734.50,
            'order_total_due'       => 0.00,
            'order_shipping_method' => 1,
            'order_payment_type'    => 'Debit Card',
            'order_shipper_id'      => 2,
            'order_shipping_person' => 'John Jonson',
            'order_shipping_phone'  => '+8801234567890',
            'order_shipping_address'=> '109/5, Hatembag Road, East Rayer Bazaar',
            'order_shipping_area'   => 'Dhaka',
            'order_shipping_city'   => 'Dhaka',
            'order_shipping_state'  => 'Dhaka',
            'order_shipping_country'=> 'Bangladesh',
            'order_shipping_postcode'=> 1209,
            'order_payment_status'  => 'Paid',
            'order_log'             => $log,
            'order_progress'        => 'on delivery',
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);

        DB::table('orders')->insert([
            'order_no'              => '1806190005',
            'order_client_id'       => 1,
            'order_products_total'  => 1734.50,
            'order_total'           => 1734.50,
            'order_total_due'       => 0.00,
            'order_shipping_method' => 1,
            'order_shipping_person' => 'John Jonson',
            'order_shipping_phone'  => '+8801234567890',
            'order_shipping_address'=> '109/5, Hatembag Road, East Rayer Bazaar',
            'order_shipping_area'   => 'Dhaka',
            'order_shipping_city'   => 'Dhaka',
            'order_shipping_state'  => 'Dhaka',
            'order_shipping_country'=> 'Bangladesh',
            'order_shipping_postcode'=> 1209,
            'order_payment_type'    => 'Credit Card',
            'order_payment_status'  => 'Paid',
            'order_log'             => $log,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);

        DB::table('orders')->insert([
            'order_no'              => '1806190006',
            'order_client_id'       => 1,
            'order_products_total'  => 9850.00,
            'order_total'           => 9850.00,
            'order_total_due'       => 9850.00,
            'order_shipping_method' => 1,
            'order_shipper_id'      => 1,
            'order_shipping_person' => 'John Jonson',
            'order_shipping_phone'  => '+8801234567890',
            'order_shipping_address'=> '109/5, Hatembag Road, East Rayer Bazaar',
            'order_shipping_area'   => 'Dhaka',
            'order_shipping_city'   => 'Dhaka',
            'order_shipping_state'  => 'Dhaka',
            'order_shipping_country'=> 'Bangladesh',
            'order_shipping_postcode'=> 1209,
            'order_payment_type'    => 'Cash on Delivery',
            'order_payment_status'  => 'Due',
            'order_progress'        => 'canceled',
            'created_at'            => Carbon::yesterday(),
            'updated_at'            => Carbon::yesterday()
        ]);

        DB::table('orders')->insert([
            'order_no'              => '1806190007',
            'order_client_id'       => 1,
            'order_products_total'  => 80.00,
            'order_total'           => 100.00,
            'order_total_due'       => 0.00,
            'order_shipping_method' => 1,
            'order_shipper_id'      => 1,
            'order_shipping_person' => 'John Jonson',
            'order_shipping_phone'  => '+8801234567890',
            'order_shipping_address'=> '109/5, Hatembag Road, East Rayer Bazaar',
            'order_shipping_area'   => 'Dhaka',
            'order_shipping_city'   => 'Dhaka',
            'order_shipping_state'  => 'Dhaka',
            'order_shipping_country'=> 'Bangladesh',
            'order_shipping_postcode'=> 1209,
            'order_payment_type'    => 'Cash on Delivery',
            'order_payment_status'  => 'Paid',
            'order_progress'        => 'delivered',
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);

        DB::table('orders')->insert([
            'order_no'              => '1806190008',
            'order_client_id'       => 1,
            'order_products_total'  => 100.00,
            'order_total'           => 100.00,
            'order_total_due'       => 100.00,
            'order_shipping_method' => 1,
            'order_shipper_id'      => 4,
            'order_shipping_person' => 'John Jonson',
            'order_shipping_phone'  => '+8801234567890',
            'order_shipping_address'=> '109/5, Hatembag Road, East Rayer Bazaar',
            'order_shipping_area'   => 'Dhaka',
            'order_shipping_city'   => 'Dhaka',
            'order_shipping_state'  => 'Dhaka',
            'order_shipping_country'=> 'Bangladesh',
            'order_shipping_postcode'=> 1209,
            'order_payment_type'    => 'Cash on Delivery',
            'order_payment_status'  => 'Due',
            'order_progress'        => 'on delivery',
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);

        DB::table('orders')->insert([
            'order_no'              => '1806190009',
            'order_client_id'       => 1,
            'order_products_total'  => 100.00,
            'order_total'           => 100.00,
            'order_total_due'       => 100.00,
            'order_shipping_method' => 1,
            'order_shipper_id'      => 1,
            'order_shipping_person' => 'John Jonson',
            'order_shipping_phone'  => '+8801234567890',
            'order_shipping_address'=> '109/5, Hatembag Road, East Rayer Bazaar',
            'order_shipping_area'   => 'Dhaka',
            'order_shipping_city'   => 'Dhaka',
            'order_shipping_state'  => 'Dhaka',
            'order_shipping_country'=> 'Bangladesh',
            'order_shipping_postcode'=> 1209,
            'order_payment_type'    => 'Cash on Delivery',
            'order_payment_status'  => 'Due',
            'order_progress'        => 'on delivery',
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);

        DB::table('orders')->insert([
            'order_no'              => '1806190010',
            'order_client_id'       => 1,
            'order_products_total'  => 100.00,
            'order_total'           => 100.00,
            'order_total_due'       => 100.00,
            'order_shipping_method' => 1,
            'order_shipper_id'      => 5,
            'order_shipping_person' => 'John Jonson',
            'order_shipping_phone'  => '+8801234567890',
            'order_shipping_address'=> '109/5, Hatembag Road, East Rayer Bazaar',
            'order_shipping_area'   => 'Dhaka',
            'order_shipping_city'   => 'Dhaka',
            'order_shipping_state'  => 'Dhaka',
            'order_shipping_country'=> 'Bangladesh',
            'order_shipping_postcode'=> 1209,
            'order_payment_type'    => 'Cash on Delivery',
            'order_payment_status'  => 'Due',
            'order_progress'        => 'on delivery',
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);

        DB::table('orders')->insert([
            'order_no'              => '1806190011',
            'order_client_id'       => 1,
            'order_products_total'  => 100.00,
            'order_total'           => 100.00,
            'order_total_due'       => 100.00,
            'order_shipping_method' => 1,
            'order_shipper_id'      => 5,
            'order_shipping_person' => 'John Jonson',
            'order_shipping_phone'  => '+8801234567890',
            'order_shipping_address'=> '109/5, Hatembag Road, East Rayer Bazaar',
            'order_shipping_area'   => 'Dhaka',
            'order_shipping_city'   => 'Dhaka',
            'order_shipping_state'  => 'Dhaka',
            'order_shipping_country'=> 'Bangladesh',
            'order_shipping_postcode'=> 1209,
            'order_payment_type'    => 'Cash on Delivery',
            'order_payment_status'  => 'Due',
            'order_progress'        => 'on delivery',
            'created_at'            => Carbon::create(2018, 05, 12, 00, 00, 00),
            'updated_at'            => Carbon::create(2018, 05, 12, 00, 00, 00)
        ]);

        DB::table('orders')->insert([
            'order_no'              => '1806190012',
            'order_client_id'       => 1,
            'order_products_total'  => 100.00,
            'order_total'           => 100.00,
            'order_total_due'       => 100.00,
            'order_shipping_method' => 1,
            'order_shipper_id'      => 1,
            'order_shipping_person' => 'John Jonson',
            'order_shipping_phone'  => '+8801234567890',
            'order_shipping_address'=> '109/5, Hatembag Road, East Rayer Bazaar',
            'order_shipping_area'   => 'Dhaka',
            'order_shipping_city'   => 'Dhaka',
            'order_shipping_state'  => 'Dhaka',
            'order_shipping_country'=> 'Bangladesh',
            'order_shipping_postcode'=> 1209,
            'order_payment_type'    => 'Cash on Delivery',
            'order_payment_status'  => 'Due',
            'order_progress'        => 'on delivery',
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);

        DB::table('orders')->insert([
            'order_no'              => '1806190013',
            'order_client_id'       => 1,
            'order_products_total'  => 100.00,
            'order_total'           => 100.00,
            'order_total_due'       => 0.00,
            'order_shipping_method' => 1,
            'order_shipper_id'      => 3,
            'order_shipping_person' => 'John Jonson',
            'order_shipping_phone'  => '+8801234567890',
            'order_shipping_address'=> '109/5, Hatembag Road, East Rayer Bazaar',
            'order_shipping_area'   => 'Dhaka',
            'order_shipping_city'   => 'Dhaka',
            'order_shipping_state'  => 'Dhaka',
            'order_shipping_country'=> 'Bangladesh',
            'order_shipping_postcode'=> 1209,
            'order_payment_type'    => 'Debit Card',
            'order_payment_status'  => 'Paid',
            'order_progress'        => 'delivered',
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);

        DB::table('orders')->insert([
            'order_no'              => '1806190014',
            'order_client_id'       => 2,
            'order_products_total'  => 780.00,
            'order_total'           => 780.00,
            'order_total_due'       => 780.00,
            'order_shipping_method' => 1,
            'order_shipping_person' => 'John Jonson',
            'order_shipping_phone'  => '+8801234567890',
            'order_shipping_address'=> '109/5, Hatembag Road, East Rayer Bazaar',
            'order_shipping_area'   => 'Dhaka',
            'order_shipping_city'   => 'Dhaka',
            'order_shipping_state'  => 'Dhaka',
            'order_shipping_country'=> 'Bangladesh',
            'order_shipping_postcode'=> 1209,
            'order_payment_type'    => 'Cash on Delivery',
            'order_payment_status'  => 'Due',
            'order_progress'        => 'canceled',
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);

        DB::table('orders')->insert([
            'order_no'              => '1806190015',
            'order_client_id'       => 3,
            'order_products_total'  => 761.00,
            'order_total'           => 761.00,
            'order_total_due'       => 0.00,
            'order_shipping_method' => 1,
            'order_shipper_id'      => 2,
            'order_shipping_person' => 'John Jonson',
            'order_shipping_phone'  => '+8801234567890',
            'order_shipping_address'=> '109/5, Hatembag Road, East Rayer Bazaar',
            'order_shipping_area'   => 'Dhaka',
            'order_shipping_city'   => 'Dhaka',
            'order_shipping_state'  => 'Dhaka',
            'order_shipping_country'=> 'Bangladesh',
            'order_shipping_postcode'=> 1207,
            'order_payment_type'    => 'bKash',
            'order_payment_status'  => 'Paid',
            'order_progress'        => 'on delivery',
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);

        DB::table('orders')->insert([
            'order_no'              => '1806190016',
            'order_client_id'       => 4,
            'order_products_total'  => 1504.00,
            'order_total'           => 1504.00,
            'order_total_due'       => 0.00,
            'order_shipping_method' => 1,
            'order_shipper_id'      => 1,
            'order_shipping_person' => 'John Jonson',
            'order_shipping_phone'  => '+8801234567890',
            'order_shipping_address'=> '109/5, Hatembag Road, East Rayer Bazaar',
            'order_shipping_area'   => 'Dhaka',
            'order_shipping_city'   => 'Dhaka',
            'order_shipping_state'  => 'Dhaka',
            'order_shipping_country'=> 'Bangladesh',
            'order_shipping_postcode'=> 1209,
            'order_payment_type'    => 'Debit Card',
            'order_payment_status'  => 'Paid',
            'order_progress'        => 'on delivery',
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);

        DB::table('orders')->insert([
            'order_no'              => '1806190017',
            'order_client_id'       => 1,
            'order_products_total'  => 598.00,
            'order_total'           => 598.00,
            'order_total_due'       => 0.00,
            'order_shipping_method' => 1,
            'order_shipping_person' => 'John Jonson',
            'order_shipping_phone'  => '+8801234567890',
            'order_shipping_address'=> '109/5, Hatembag Road, East Rayer Bazaar',
            'order_shipping_area'   => 'Dhaka',
            'order_shipping_city'   => 'Dhaka',
            'order_shipping_state'  => 'Dhaka',
            'order_shipping_country'=> 'Bangladesh',
            'order_shipping_postcode'=> 1209,
            'order_payment_type'    => 'Credit Card',
            'order_payment_status'  => 'Paid',
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);

        DB::table('orders')->insert([
            'order_no'              => '1806190018',
            'order_client_id'       => 1,
            'order_products_total'  => 9850.00,
            'order_total'           => 9850.00,
            'order_total_due'       => 9850.00,
            'order_shipping_method' => 1,
            'order_shipping_person' => 'John Jonson',
            'order_shipping_phone'  => '+8801234567890',
            'order_shipping_address'=> '109/5, Hatembag Road, East Rayer Bazaar',
            'order_shipping_area'   => 'Dhaka',
            'order_shipping_city'   => 'Dhaka',
            'order_shipping_state'  => 'Dhaka',
            'order_shipping_country'=> 'Bangladesh',
            'order_shipping_postcode'=> 1209,
            'order_payment_type'    => 'Cash on Delivery',
            'order_payment_status'  => 'Due',
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);

        DB::table('orders')->insert([
            'order_no'              => '1806190019',
            'order_client_id'       => 1,
            'order_products_total'  => 100.00,
            'order_total'           => 100.00,
            'order_total_due'       => 100.00,
            'order_shipping_method' => 1,
            'order_shipping_person' => 'John Jonson',
            'order_shipping_phone'  => '+8801234567890',
            'order_shipping_address'=> '109/5, Hatembag Road, East Rayer Bazaar',
            'order_shipping_area'   => 'Dhaka',
            'order_shipping_city'   => 'Dhaka',
            'order_shipping_state'  => 'Dhaka',
            'order_shipping_country'=> 'Bangladesh',
            'order_shipping_postcode'=> 1209,
            'order_payment_type'    => 'Cash on Delivery',
            'order_payment_status'  => 'Due',
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);

        DB::table('orders')->insert([
            'order_no'              => '1806190020',
            'order_client_id'       => 1,
            'order_products_total'  => 100.00,
            'order_total'           => 100.00,
            'order_total_due'       => 100.00,
            'order_shipping_method' => 1,
            'order_shipping_person' => 'John Jonson',
            'order_shipping_phone'  => '+8801234567890',
            'order_shipping_address'=> '109/5, Hatembag Road, East Rayer Bazaar',
            'order_shipping_area'   => 'Dhaka',
            'order_shipping_city'   => 'Dhaka',
            'order_shipping_state'  => 'Dhaka',
            'order_shipping_country'=> 'Bangladesh',
            'order_shipping_postcode'=> 1209,
            'order_payment_type'    => 'Cash on Delivery',
            'order_payment_status'  => 'Due',
            'created_at'            => Carbon::create(2018, 05, 12, 00, 00, 00),
            'updated_at'            => Carbon::create(2018, 05, 12, 00, 00, 00)
        ]);

        DB::table('orders')->insert([
            'order_no'              => '1806190021',
            'order_client_id'       => 1,
            'order_products_total'  => 100.00,
            'order_total'           => 100.00,
            'order_total_due'       => 100.00,
            'order_shipping_method' => 1,
            'order_shipping_person' => 'John Jonson',
            'order_shipping_phone'  => '+8801234567890',
            'order_shipping_address'=> '109/5, Hatembag Road, East Rayer Bazaar',
            'order_shipping_area'   => 'Dhaka',
            'order_shipping_city'   => 'Dhaka',
            'order_shipping_state'  => 'Dhaka',
            'order_shipping_country'=> 'Bangladesh',
            'order_shipping_postcode'=> 1209,
            'order_payment_type'    => 'Cash on Delivery',
            'order_payment_status'  => 'Due',
            'created_at'            => Carbon::create(2018, 05, 12, 00, 00, 00),
            'updated_at'            => Carbon::create(2018, 05, 12, 00, 00, 00)
        ]);

        DB::table('orders')->insert([
            'order_no'              => '1806190022',
            'order_client_id'       => 1,
            'order_products_total'  => 100.00,
            'order_total'           => 100.00,
            'order_total_due'       => 100.00,
            'order_shipping_method' => 1,
            'order_shipping_person' => 'John Jonson',
            'order_shipping_phone'  => '+8801234567890',
            'order_shipping_address'=> '109/5, Hatembag Road, East Rayer Bazaar',
            'order_shipping_area'   => 'Dhaka',
            'order_shipping_city'   => 'Dhaka',
            'order_shipping_state'  => 'Dhaka',
            'order_shipping_country'=> 'Bangladesh',
            'order_shipping_postcode'=> 1209,
            'order_payment_type'    => 'Cash on Delivery',
            'order_payment_status'  => 'Due',
            'created_at'            => Carbon::create(2018, 05, 12, 00, 00, 00),
            'updated_at'            => Carbon::create(2018, 05, 12, 00, 00, 00)
        ]);

        DB::table('orders')->insert([
            'order_no'              => '1806190023',
            'order_client_id'       => 1,
            'order_products_total'  => 100.00,
            'order_total'           => 100.00,
            'order_total_due'       => 100.00,
            'order_shipping_method' => 1,
            'order_shipping_person' => 'John Jonson',
            'order_shipping_phone'  => '+8801234567890',
            'order_shipping_address'=> '109/5, Hatembag Road, East Rayer Bazaar',
            'order_shipping_area'   => 'Dhaka',
            'order_shipping_city'   => 'Dhaka',
            'order_shipping_state'  => 'Dhaka',
            'order_shipping_country'=> 'Bangladesh',
            'order_shipping_postcode'=> 1209,
            'order_payment_type'    => 'Cash on Delivery',
            'order_payment_status'  => 'Due',
            'created_at'            => Carbon::create(2018, 05, 12, 00, 00, 00),
            'updated_at'            => Carbon::create(2018, 05, 12, 00, 00, 00)
        ]);

        DB::table('orders')->insert([
            'order_no'              => '1806190024',
            'order_client_id'       => 1,
            'order_products_total'  => 100.00,
            'order_total'           => 100.00,
            'order_total_due'       => 100.00,
            'order_shipping_method' => 1,
            'order_shipping_person' => 'John Jonson',
            'order_shipping_phone'  => '+8801234567890',
            'order_shipping_address'=> '109/5, Hatembag Road, East Rayer Bazaar',
            'order_shipping_area'   => 'Dhaka',
            'order_shipping_city'   => 'Dhaka',
            'order_shipping_state'  => 'Dhaka',
            'order_shipping_country'=> 'Bangladesh',
            'order_shipping_postcode'=> 1209,
            'order_payment_type'    => 'Cash on Delivery',
            'order_payment_status'  => 'Due',
            'created_at'            => Carbon::create(2018, 05, 12, 00, 00, 00),
            'updated_at'            => Carbon::create(2018, 05, 12, 00, 00, 00)
        ]);
    }
}
