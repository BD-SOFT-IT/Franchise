<?php

use Illuminate\Database\Seeder;

class OrderDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_details')->insert([
            'od_order_id'           => 1,
            'od_product_id'         => 1,
            'od_product_unit_cost'  => 80.00,
            'od_product_unit_mrp'   => 100.00,
            'od_product_quantity'   => 4,
            'od_product_total'      => 400.00,
            'created_at'            => \Carbon\Carbon::now(),
            'updated_at'            => \Carbon\Carbon::now()
        ]);

        DB::table('order_details')->insert([
            'od_order_id'           => 1,
            'od_product_id'         => 2,
            'od_product_unit_cost'  => 245.00,
            'od_product_unit_mrp'   => 280.00,
            'od_product_quantity'   => 1,
            'od_product_total'      => 280.00,
            'created_at'            => \Carbon\Carbon::now(),
            'updated_at'            => \Carbon\Carbon::now()
        ]);

        DB::table('order_details')->insert([
            'od_order_id'           => 1,
            'od_product_id'         => 3,
            'od_product_unit_cost'  => 150.00,
            'od_product_unit_mrp'   => 185.00,
            'od_product_quantity'   => 2,
            'od_product_total'      => 370.00,
            'created_at'            => \Carbon\Carbon::now(),
            'updated_at'            => \Carbon\Carbon::now()
        ]);

        DB::table('order_details')->insert([
            'od_order_id'           => 1,
            'od_product_id'         => 59,
            'od_product_unit_cost'  => 150.00,
            'od_product_unit_mrp'   => 185.00,
            'od_product_quantity'   => 2,
            'od_product_discount_amount' => 37,
            'od_product_total'      => 333.00,
            'created_at'            => \Carbon\Carbon::now(),
            'updated_at'            => \Carbon\Carbon::now()
        ]);

        DB::table('order_details')->insert([
            'od_order_id'           => 1,
            'od_product_id'         => 59,
            'od_product_unit_cost'  => 150.00,
            'od_product_unit_mrp'   => 185.00,
            'od_product_quantity'   => 1,
            'od_product_discount_percentage' => 10,
            'od_product_total'      => 351.50,
            'created_at'            => \Carbon\Carbon::now(),
            'updated_at'            => \Carbon\Carbon::now()
        ]);



        DB::table('order_details')->insert([
            'od_order_id'           => 2,
            'od_product_id'         => 1,
            'od_product_unit_cost'  => 80.00,
            'od_product_unit_mrp'   => 100.00,
            'od_product_quantity'   => 4,
            'od_product_total'      => 400.00,
            'created_at'            => \Carbon\Carbon::now(),
            'updated_at'            => \Carbon\Carbon::now()
        ]);

        DB::table('order_details')->insert([
            'od_order_id'           => 2,
            'od_product_id'         => 2,
            'od_product_unit_cost'  => 245.00,
            'od_product_unit_mrp'   => 280.00,
            'od_product_quantity'   => 1,
            'od_product_total'      => 280.00,
            'created_at'            => \Carbon\Carbon::now(),
            'updated_at'            => \Carbon\Carbon::now()
        ]);

        DB::table('order_details')->insert([
            'od_order_id'           => 2,
            'od_product_id'         => 3,
            'od_product_unit_cost'  => 150.00,
            'od_product_unit_mrp'   => 185.00,
            'od_product_quantity'   => 2,
            'od_product_total'      => 370.00,
            'created_at'            => \Carbon\Carbon::now(),
            'updated_at'            => \Carbon\Carbon::now()
        ]);

        DB::table('order_details')->insert([
            'od_order_id'           => 2,
            'od_product_id'         => 59,
            'od_product_unit_cost'  => 150.00,
            'od_product_unit_mrp'   => 185.00,
            'od_product_quantity'   => 2,
            'od_product_discount_percentage' => 10,
            'od_product_total'      => 333.00,
            'created_at'            => \Carbon\Carbon::now(),
            'updated_at'            => \Carbon\Carbon::now()
        ]);

        DB::table('order_details')->insert([
            'od_order_id'           => 2,
            'od_product_id'         => 59,
            'od_product_unit_cost'  => 150.00,
            'od_product_unit_mrp'   => 185.00,
            'od_product_quantity'   => 1,
            'od_product_discount_percentage' => 10,
            'od_product_total'      => 351.50,
            'created_at'            => \Carbon\Carbon::now(),
            'updated_at'            => \Carbon\Carbon::now()
        ]);



        DB::table('order_details')->insert([
            'od_order_id'           => 3,
            'od_product_id'         => 1,
            'od_product_unit_cost'  => 80.00,
            'od_product_unit_mrp'   => 100.00,
            'od_product_quantity'   => 4,
            'od_product_total'      => 400.00,
            'created_at'            => \Carbon\Carbon::now(),
            'updated_at'            => \Carbon\Carbon::now()
        ]);

        DB::table('order_details')->insert([
            'od_order_id'           => 3,
            'od_product_id'         => 2,
            'od_product_unit_cost'  => 245.00,
            'od_product_unit_mrp'   => 280.00,
            'od_product_quantity'   => 1,
            'od_product_total'      => 280.00,
            'created_at'            => \Carbon\Carbon::now(),
            'updated_at'            => \Carbon\Carbon::now()
        ]);

        DB::table('order_details')->insert([
            'od_order_id'           => 3,
            'od_product_id'         => 3,
            'od_product_unit_cost'  => 150.00,
            'od_product_unit_mrp'   => 185.00,
            'od_product_quantity'   => 2,
            'od_product_total'      => 370.00,
            'created_at'            => \Carbon\Carbon::now(),
            'updated_at'            => \Carbon\Carbon::now()
        ]);

        DB::table('order_details')->insert([
            'od_order_id'           => 3,
            'od_product_id'         => 59,
            'od_product_unit_cost'  => 150.00,
            'od_product_unit_mrp'   => 185.00,
            'od_product_quantity'   => 2,
            'od_product_discount_percentage' => 10,
            'od_product_total'      => 333.00,
            'created_at'            => \Carbon\Carbon::now(),
            'updated_at'            => \Carbon\Carbon::now()
        ]);

        DB::table('order_details')->insert([
            'od_order_id'           => 3,
            'od_product_id'         => 59,
            'od_product_unit_cost'  => 150.00,
            'od_product_unit_mrp'   => 185.00,
            'od_product_quantity'   => 1,
            'od_product_discount_percentage' => 10,
            'od_product_total'      => 351.50,
            'created_at'            => \Carbon\Carbon::now(),
            'updated_at'            => \Carbon\Carbon::now()
        ]);



        DB::table('order_details')->insert([
            'od_order_id'           => 4,
            'od_product_id'         => 1,
            'od_product_unit_cost'  => 80.00,
            'od_product_unit_mrp'   => 100.00,
            'od_product_quantity'   => 4,
            'od_product_total'      => 400.00,
            'created_at'            => \Carbon\Carbon::now(),
            'updated_at'            => \Carbon\Carbon::now()
        ]);

        DB::table('order_details')->insert([
            'od_order_id'           => 4,
            'od_product_id'         => 2,
            'od_product_unit_cost'  => 245.00,
            'od_product_unit_mrp'   => 280.00,
            'od_product_quantity'   => 1,
            'od_product_total'      => 280.00,
            'created_at'            => \Carbon\Carbon::now(),
            'updated_at'            => \Carbon\Carbon::now()
        ]);

        DB::table('order_details')->insert([
            'od_order_id'           => 4,
            'od_product_id'         => 3,
            'od_product_unit_cost'  => 150.00,
            'od_product_unit_mrp'   => 185.00,
            'od_product_quantity'   => 2,
            'od_product_total'      => 370.00,
            'created_at'            => \Carbon\Carbon::now(),
            'updated_at'            => \Carbon\Carbon::now()
        ]);

        DB::table('order_details')->insert([
            'od_order_id'           => 4,
            'od_product_id'         => 59,
            'od_product_unit_cost'  => 150.00,
            'od_product_unit_mrp'   => 185.00,
            'od_product_quantity'   => 2,
            'od_product_discount_percentage' => 10,
            'od_product_total'      => 333.00,
            'created_at'            => \Carbon\Carbon::now(),
            'updated_at'            => \Carbon\Carbon::now()
        ]);

        DB::table('order_details')->insert([
            'od_order_id'           => 4,
            'od_product_id'         => 59,
            'od_product_unit_cost'  => 150.00,
            'od_product_unit_mrp'   => 185.00,
            'od_product_quantity'   => 1,
            'od_product_discount_percentage' => 10,
            'od_product_total'      => 351.50,
            'created_at'            => \Carbon\Carbon::now(),
            'updated_at'            => \Carbon\Carbon::now()
        ]);



        DB::table('order_details')->insert([
            'od_order_id'           => 5,
            'od_product_id'         => 1,
            'od_product_unit_cost'  => 80.00,
            'od_product_unit_mrp'   => 100.00,
            'od_product_quantity'   => 4,
            'od_product_total'      => 400.00,
            'created_at'            => \Carbon\Carbon::now(),
            'updated_at'            => \Carbon\Carbon::now()
        ]);

        DB::table('order_details')->insert([
            'od_order_id'           => 5,
            'od_product_id'         => 2,
            'od_product_unit_cost'  => 245.00,
            'od_product_unit_mrp'   => 280.00,
            'od_product_quantity'   => 1,
            'od_product_total'      => 280.00,
            'created_at'            => \Carbon\Carbon::now(),
            'updated_at'            => \Carbon\Carbon::now()
        ]);

        DB::table('order_details')->insert([
            'od_order_id'           => 5,
            'od_product_id'         => 3,
            'od_product_unit_cost'  => 150.00,
            'od_product_unit_mrp'   => 185.00,
            'od_product_quantity'   => 2,
            'od_product_total'      => 370.00,
            'created_at'            => \Carbon\Carbon::now(),
            'updated_at'            => \Carbon\Carbon::now()
        ]);

        DB::table('order_details')->insert([
            'od_order_id'           => 5,
            'od_product_id'         => 59,
            'od_product_unit_cost'  => 150.00,
            'od_product_unit_mrp'   => 185.00,
            'od_product_quantity'   => 2,
            'od_product_discount_percentage' => 10,
            'od_product_total'      => 333.00,
            'created_at'            => \Carbon\Carbon::now(),
            'updated_at'            => \Carbon\Carbon::now()
        ]);

        DB::table('order_details')->insert([
            'od_order_id'           => 5,
            'od_product_id'         => 60,
            'od_product_unit_cost'  => 150.00,
            'od_product_unit_mrp'   => 185.00,
            'od_product_quantity'   => 1,
            'od_product_discount_amount' => 18.50,
            'od_product_total'      => 351.50,
            'created_at'            => \Carbon\Carbon::now(),
            'updated_at'            => \Carbon\Carbon::now()
        ]);
    }
}
