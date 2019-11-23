<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 10; $i++) {
            DB::table('product_categories')->insert([
                'pc_category_id'        => 1,
                'pc_product_id'         => $i,
                'created_at'            => \Carbon\Carbon::now(),
                'updated_at'            => \Carbon\Carbon::now()
            ]);
        }

        for($i = 11; $i <= 20; $i++) {
            DB::table('product_categories')->insert([
                'pc_category_id'        => 2,
                'pc_product_id'         => $i,
                'created_at'            => \Carbon\Carbon::now(),
                'updated_at'            => \Carbon\Carbon::now()
            ]);
        }

        for($i = 1; $i <= 10; $i++) {
            DB::table('product_categories')->insert([
                'pc_category_id'        => 2,
                'pc_product_id'         => $i,
                'created_at'            => \Carbon\Carbon::now(),
                'updated_at'            => \Carbon\Carbon::now()
            ]);
        }

        for($i = 20; $i <= 50; $i++) {
            DB::table('product_categories')->insert([
                'pc_category_id'        => 1,
                'pc_product_id'         => $i,
                'created_at'            => \Carbon\Carbon::now(),
                'updated_at'            => \Carbon\Carbon::now()
            ]);
        }

        for($i = 1; $i <= 10; $i++) {
            DB::table('product_categories')->insert([
                'pc_category_id'        => 2,
                'pc_product_id'         => $i,
                'created_at'            => \Carbon\Carbon::now(),
                'updated_at'            => \Carbon\Carbon::now()
            ]);
        }

        for($i = 1; $i <= 10; $i++) {
            DB::table('product_categories')->insert([
                'pc_category_id'        => 4,
                'pc_product_id'         => $i,
                'created_at'            => \Carbon\Carbon::now(),
                'updated_at'            => \Carbon\Carbon::now()
            ]);
        }

        for($i = 1; $i <= 10; $i++) {
            DB::table('product_categories')->insert([
                'pc_category_id'        => 7,
                'pc_product_id'         => $i,
                'created_at'            => \Carbon\Carbon::now(),
                'updated_at'            => \Carbon\Carbon::now()
            ]);
        }

        for($i = 1; $i <= 10; $i++) {
            DB::table('product_categories')->insert([
                'pc_category_id'        => 19,
                'pc_product_id'         => $i,
                'created_at'            => \Carbon\Carbon::now(),
                'updated_at'            => \Carbon\Carbon::now()
            ]);
        }

        for($i = 35; $i <= 55; $i++) {
            DB::table('product_categories')->insert([
                'pc_category_id'        => 1,
                'pc_product_id'         => $i,
                'created_at'            => \Carbon\Carbon::now(),
                'updated_at'            => \Carbon\Carbon::now()
            ]);
        }

        for($i = 35; $i <= 55; $i++) {
            DB::table('product_categories')->insert([
                'pc_category_id'        => 2,
                'pc_product_id'         => $i,
                'created_at'            => \Carbon\Carbon::now(),
                'updated_at'            => \Carbon\Carbon::now()
            ]);
        }

        for($i = 35; $i <= 55; $i++) {
            DB::table('product_categories')->insert([
                'pc_category_id'        => 3,
                'pc_product_id'         => $i,
                'created_at'            => \Carbon\Carbon::now(),
                'updated_at'            => \Carbon\Carbon::now()
            ]);
        }

    }
}
