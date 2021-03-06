<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $description = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.';
        $description_bengali = 'খ্রিস্টীয় দশম থেকে দ্বাদশ শতাব্দীর মধ্যবর্তী সময়কালে মাগধী প্রাকৃত ও পালির মতো পূর্ব মধ্য ইন্দো-আর্য ভাষাসমূহ থেকে বাংলা ও অন্যান্য পূর্ব ইন্দো-আর্য ভাষাগুলির উদ্ভব ঘটে। এই অঞ্চলে কথ্য ভাষা প্রথম সহস্রাব্দে মাগধী প্রাকৃত বা অর্ধমাগধী ভাষায় বিবর্তিত হয়। খ্রিস্টীয় দশম শতাব্দীর শুরুতে উত্তর ভারতের অন্যান্য প্রাকৃত ভাষার মতোই মাগধী প্রাকৃত থেকে অপভ্রংশ ভাষাগুলির উদ্ভব ঘটে। পূর্বী অপভ্রংশ বা অবহট্‌ঠ নামক পূর্ব উপমহাদেশের স্থানীয় অপভ্রংশ ভাষাগুলি ধীরে ধীরে আঞ্চলিক কথ্য ভাষায় বিবর্তিত হয়, যা মূলতঃ ওড়িয়া ভাষা, বাংলা-অসমীয়া ও বিহারী ভাষাসমূহের জন্ম দেয়। কোনো কোনো ভাষাবিদ ৫০০ খ্রিস্টাব্দে এই তিন ভাষার জন্ম বলে মনে করলেও এই ভাষাটি তখন পর্যন্ত কোনো সুস্থির রূপ ধারণ করেনি; সে সময় এর বিভিন্ন লিখিত ও ঔপভাষিক রূপ পাশাপাশি বিদ্যমান ছিল। যেমন, ধারণা করা হয়, আনুমানিক ষষ্ঠ শতাব্দীতে মাগধী অপভ্রংশ থেকে অবহট্‌ঠের উদ্ভব ঘটে, যা প্রাক-বাংলা ভাষাগুলির সঙ্গে কিছু সময় ধরে সহাবস্থান করছিল।';
        $new_log = [
            'type'          => 'vendor data updated',
            'author_id'     => 1,
            'author_name'   => 'Jonson Bhowmik',
            'old_cost'      => 'null',
            'new_cost'      => 'null',
            'old_mrp'       => 'null',
            'new_mrp'       => 'null',
            'old_stock'     => 'null',
            'new_stock'     => 'null',
            'time'          => Carbon::now()
        ];
        $log = makeNewLog($new_log, null, true);


        DB::table('products')->insert([
            'product_sku'                   => 'SKU0011229',
            'product_vendor'                => null,
            'product_vendor_sku'            => '',
            'product_title'                 => 'Red Grapes 250 gm',
            'product_title_bengali'         => 'লাল আঙুর ২৫০ গ্রাম',
            'product_slug'                  => 'red-grapes-250-gm-লাল-আঙ্গুর-২৫০-গ্রাম',
            'product_description'           => $description,
            'product_description_bengali'   => $description_bengali,
            'product_description_short'     => $description,
            'product_categories'            => '',
            'product_keywords'              => 'sohoj, bazaar, grocery, online, eshop',
            'product_unit_name'             => 'Gram (gm)',
            'product_unit_quantity'         => 250,
            'product_unit_cost'             => 80,
            'product_unit_mrp'              => 100,
            'product_available_sizes'       => null,
            'product_available_colors'      => null,
            'product_discount_amount'       => null,
            'product_discount_percentage'   => null,
            'product_units_in_stock'        => null,
            'product_unit_subtract_on_order'=> false,
            'product_rank'                  => 0.00,
            'product_availability_status'   => 'In Stock',
            'product_replacement_available' => false,
            'product_guarantee_time'        => '',
            'product_guarantee_status'      => '',
            'product_active'                => true,
            'product_featured'              => false,
            'product_offered'               => false,
            'product_discounted'            => false,
            'product_available_outside'     => false,
            'product_total_unit_sold'       => 0,
            'product_img_main'              => '',
            'product_img_2'                 => '',
            'product_img_3'                 => '',
            'product_img_4'                 => '',
            'product_img_5'                 => '',
            'product_logs'                  => $log,
            'created_at'                    => \Carbon\Carbon::now(),
            'updated_at'                    => \Carbon\Carbon::now()
        ]);

        DB::table('products')->insert([
            'product_sku'                   => 'SKU0011228',
            'product_vendor'                => null,
            'product_vendor_sku'            => '',
            'product_title'                 => 'Pomegranate Dalim/Bedana (±50 gm)',
            'product_title_bengali'         => 'ডালিম / বেদানা ১ কেজি(±৫০ গ্রাম)',
            'product_slug'                  => 'pomegranate-dalim-bedana-ডালিম-বেদানা-১-কেজি',
            'product_description'           => $description,
            'product_description_bengali'   => $description_bengali,
            'product_description_short'     => $description,
            'product_categories'            => '',
            'product_keywords'              => 'sohoj, bazaar, grocery, online, eshop',
            'product_unit_name'             => 'KG',
            'product_unit_quantity'         => 1,
            'product_unit_cost'             => 245,
            'product_unit_mrp'              => 280,
            'product_available_sizes'       => null,
            'product_available_colors'      => null,
            'product_discount_amount'       => null,
            'product_discount_percentage'   => null,
            'product_units_in_stock'        => null,
            'product_unit_subtract_on_order'=> false,
            'product_rank'                  => 0.00,
            'product_availability_status'   => 'In Stock',
            'product_replacement_available' => false,
            'product_guarantee_time'        => '',
            'product_guarantee_status'      => '',
            'product_active'                => true,
            'product_featured'              => false,
            'product_offered'               => false,
            'product_discounted'            => false,
            'product_available_outside'     => false,
            'product_total_unit_sold'       => 0,
            'product_img_main'              => '',
            'product_img_2'                 => '',
            'product_img_3'                 => '',
            'product_img_4'                 => '',
            'product_img_5'                 => '',
            'product_logs'                  => $log,
            'created_at'                    => \Carbon\Carbon::now(),
            'updated_at'                    => \Carbon\Carbon::now()
        ]);

        for($i = 1; $i <= 10; $i++) {
            DB::table('products')->insert([
                'product_sku'                   => 'GAF0011229' . $i,
                'product_vendor'                => null,
                'product_vendor_sku'            => '',
                'product_title'                 => 'Grocery Product Title ' . $i,
                'product_title_bengali'         => 'পন্যের নাম ' . $i,
                'product_slug'                  => 'grocery-product-title-1-' . $i . 'পন্যের-নাম-' . $i,
                'product_description'           => $description,
                'product_description_bengali'   => $description_bengali,
                'product_description_short'     => $description,
                'product_categories'            => '',
                'product_keywords'              => 'sohoj, bazaar, grocery, online, eshop',
                'product_unit_name'             => 'Kilogram (kg)',
                'product_unit_quantity'         => 1,
                'product_unit_cost'             => 150,
                'product_unit_mrp'              => 185,
                'product_available_sizes'       => null,
                'product_available_colors'      => null,
                'product_discount_amount'       => null,
                'product_discount_percentage'   => null,
                'product_units_in_stock'        => null,
                'product_unit_subtract_on_order'=> false,
                'product_rank'                  => 0.00,
                'product_availability_status'   => 'In Stock',
                'product_replacement_available' => false,
                'product_guarantee_time'        => '',
                'product_guarantee_status'      => '',
                'product_active'                => true,
                'product_featured'              => false,
                'product_offered'               => false,
                'product_discounted'            => false,
                'product_available_outside'     => false,
                'product_total_unit_sold'       => 0,
                'product_img_main'              => '',
                'product_img_2'                 => '',
                'product_img_3'                 => '',
                'product_img_4'                 => '',
                'product_img_5'                 => '',
                'product_logs'                  => $log,
                'created_at'                    => \Carbon\Carbon::now(),
                'updated_at'                    => \Carbon\Carbon::now()
            ]);
        }

        for($i = 1; $i <= 10; $i++) {
            DB::table('products')->insert([
                'product_sku'                   => 'HA0011229' . $i,
                'product_vendor'                => null,
                'product_vendor_sku'            => '',
                'product_title'                 => 'Home Product Title ' . $i,
                'product_title_bengali'         => 'পন্যের নাম ' . $i,
                'product_slug'                  => 'home-product-title-1-' . $i . 'পন্যের-নাম-' . $i,
                'product_description'           => $description,
                'product_description_bengali'   => $description_bengali,
                'product_description_short'     => $description,
                'product_categories'            => '',
                'product_keywords'              => 'sohoj, bazaar, grocery, online, eshop',
                'product_unit_name'             => 'Piece',
                'product_unit_quantity'         => 1,
                'product_unit_cost'             => 150,
                'product_unit_mrp'              => 185,
                'product_available_sizes'       => null,
                'product_available_colors'      => null,
                'product_discount_amount'       => null,
                'product_discount_percentage'   => null,
                'product_units_in_stock'        => null,
                'product_unit_subtract_on_order'=> false,
                'product_rank'                  => 0.00,
                'product_availability_status'   => 'In Stock',
                'product_replacement_available' => false,
                'product_guarantee_time'        => '',
                'product_guarantee_status'      => '',
                'product_active'                => true,
                'product_featured'              => false,
                'product_offered'               => false,
                'product_discounted'            => false,
                'product_available_outside'     => false,
                'product_total_unit_sold'       => 0,
                'product_img_main'              => '',
                'product_img_2'                 => '',
                'product_img_3'                 => '',
                'product_img_4'                 => '',
                'product_img_5'                 => '',
                'product_logs'                  => $log,
                'created_at'                    => \Carbon\Carbon::now(),
                'updated_at'                    => \Carbon\Carbon::now()
            ]);
        }

        for($i = 1; $i <= 10; $i++) {
            DB::table('products')->insert([
                'product_sku'                   => 'MF0011229' . $i,
                'product_vendor'                => null,
                'product_vendor_sku'            => '',
                'product_title'                 => 'Men Fashion Product Title ' . $i,
                'product_title_bengali'         => 'পন্যের নাম ' . $i,
                'product_slug'                  => 'men-fashion-product-title-1-' . $i . 'পন্যের-নাম-' . $i,
                'product_description'           => $description,
                'product_description_bengali'   => $description_bengali,
                'product_description_short'     => $description,
                'product_categories'            => '',
                'product_keywords'              => 'sohoj, bazaar, grocery, online, eshop',
                'product_unit_name'             => 'Piece',
                'product_unit_quantity'         => 1,
                'product_unit_cost'             => 150,
                'product_unit_mrp'              => 185,
                'product_available_sizes'       => convertArrayToString(['S', 'M', 'L']),
                'product_available_colors'      => convertArrayToString(['Red', 'White', 'Black']),
                'product_discount_amount'       => null,
                'product_discount_percentage'   => null,
                'product_units_in_stock'        => null,
                'product_unit_subtract_on_order'=> true,
                'product_rank'                  => 0.00,
                'product_availability_status'   => 'In Stock',
                'product_replacement_available' => false,
                'product_guarantee_time'        => '',
                'product_guarantee_status'      => '',
                'product_active'                => true,
                'product_featured'              => false,
                'product_offered'               => false,
                'product_discounted'            => false,
                'product_available_outside'     => false,
                'product_total_unit_sold'       => 0,
                'product_img_main'              => '',
                'product_img_2'                 => '',
                'product_img_3'                 => '',
                'product_img_4'                 => '',
                'product_img_5'                 => '',
                'product_logs'                  => $log,
                'created_at'                    => \Carbon\Carbon::now(),
                'updated_at'                    => \Carbon\Carbon::now()
            ]);
        }

        for($i = 1; $i <= 10; $i++) {
            DB::table('products')->insert([
                'product_sku'                   => 'FO0011229' . $i,
                'product_vendor'                => null,
                'product_vendor_sku'            => '',
                'product_title'                 => 'Offered Product ' . $i,
                'product_title_bengali'         => 'পন্যের নাম ' . $i,
                'product_slug'                  => 'offered-product-title-1-' . $i . 'পন্যের-নাম-' . $i,
                'product_description'           => $description,
                'product_description_bengali'   => $description_bengali,
                'product_description_short'     => $description,
                'product_categories'            => '',
                'product_keywords'              => 'sohoj, bazaar, grocery, online, eshop',
                'product_unit_name'             => 'Piece',
                'product_unit_quantity'         => 1,
                'product_unit_cost'             => 150,
                'product_unit_mrp'              => 185,
                'product_available_sizes'       => convertArrayToString(['S', 'M', 'L']),
                'product_available_colors'      => convertArrayToString(['Red', 'White', 'Black']),
                'product_discount_amount'       => null,
                'product_discount_percentage'   => null,
                'product_units_in_stock'        => null,
                'product_unit_subtract_on_order'=> true,
                'product_rank'                  => 0.00,
                'product_availability_status'   => 'In Stock',
                'product_replacement_available' => false,
                'product_guarantee_time'        => '',
                'product_guarantee_status'      => '',
                'product_active'                => true,
                'product_featured'              => false,
                'product_offered'               => true,
                'product_discounted'            => false,
                'product_available_outside'     => false,
                'product_total_unit_sold'       => 0,
                'product_img_main'              => '',
                'product_img_2'                 => '',
                'product_img_3'                 => '',
                'product_img_4'                 => '',
                'product_img_5'                 => '',
                'product_logs'                  => $log,
                'created_at'                    => \Carbon\Carbon::now(),
                'updated_at'                    => \Carbon\Carbon::now()
            ]);
        }

        for($i = 1; $i <= 10; $i++) {
            DB::table('products')->insert([
                'product_sku'                   => 'FF0011229' . $i,
                'product_vendor'                => null,
                'product_vendor_sku'            => '',
                'product_title'                 => 'Featured Product ' . $i,
                'product_title_bengali'         => 'পন্যের নাম ' . $i,
                'product_slug'                  => 'featured-product-title-1-' . $i . 'পন্যের-নাম-' . $i,
                'product_description'           => $description,
                'product_description_bengali'   => $description_bengali,
                'product_description_short'     => $description,
                'product_categories'            => '',
                'product_keywords'              => 'sohoj, bazaar, grocery, online, eshop',
                'product_unit_name'             => 'Piece',
                'product_unit_quantity'         => 1,
                'product_unit_cost'             => 150,
                'product_unit_mrp'              => 185,
                'product_available_sizes'       => convertArrayToString(['S', 'M', 'L']),
                'product_available_colors'      => convertArrayToString(['Red', 'White', 'Black']),
                'product_discount_amount'       => null,
                'product_discount_percentage'   => null,
                'product_units_in_stock'        => null,
                'product_unit_subtract_on_order'=> true,
                'product_rank'                  => 0.00,
                'product_availability_status'   => 'In Stock',
                'product_replacement_available' => false,
                'product_guarantee_time'        => '',
                'product_guarantee_status'      => '',
                'product_active'                => true,
                'product_featured'              => true,
                'product_offered'               => false,
                'product_discounted'            => false,
                'product_available_outside'     => false,
                'product_total_unit_sold'       => 0,
                'product_img_main'              => '',
                'product_img_2'                 => '',
                'product_img_3'                 => '',
                'product_img_4'                 => '',
                'product_img_5'                 => '',
                'product_logs'                  => $log,
                'created_at'                    => \Carbon\Carbon::now(),
                'updated_at'                    => \Carbon\Carbon::now()
            ]);
        }

        for($i = 1; $i <= 10; $i++) {
            DB::table('products')->insert([
                'product_sku'                   => 'FD0011229' . $i,
                'product_vendor'                => null,
                'product_vendor_sku'            => '',
                'product_title'                 => 'Discounted Product ' . $i,
                'product_title_bengali'         => 'পন্যের নাম ' . $i,
                'product_slug'                  => 'discounted-product-title-' . $i . 'পন্যের-নাম-' . $i,
                'product_description'           => $description,
                'product_description_bengali'   => $description_bengali,
                'product_description_short'     => $description,
                'product_categories'            => '',
                'product_keywords'              => 'sohoj, bazaar, grocery, online, eshop',
                'product_unit_name'             => 'Piece',
                'product_unit_quantity'         => 1,
                'product_unit_cost'             => 150,
                'product_unit_mrp'              => 185,
                'product_available_sizes'       => convertArrayToString(['S', 'M', 'L']),
                'product_available_colors'      => convertArrayToString(['Red', 'White', 'Black']),
                'product_discount_amount'       => null,
                'product_discount_percentage'   => 10.00,
                'product_units_in_stock'        => null,
                'product_unit_subtract_on_order'=> true,
                'product_rank'                  => 0.00,
                'product_availability_status'   => 'In Stock',
                'product_replacement_available' => false,
                'product_guarantee_time'        => '',
                'product_guarantee_status'      => '',
                'product_active'                => true,
                'product_featured'              => false,
                'product_offered'               => false,
                'product_discounted'            => true,
                'product_available_outside'     => false,
                'product_total_unit_sold'       => 0,
                'product_img_main'              => '',
                'product_img_2'                 => '',
                'product_img_3'                 => '',
                'product_img_4'                 => '',
                'product_img_5'                 => '',
                'product_logs'                  => $log,
                'created_at'                    => \Carbon\Carbon::now(),
                'updated_at'                    => \Carbon\Carbon::now()
            ]);
        }

        for($i = 1; $i <= 10; $i++) {
            DB::table('products')->insert([
                'product_sku'                   => 'FAO0011229' . $i,
                'product_vendor'                => null,
                'product_vendor_sku'            => '',
                'product_title'                 => 'Outside Product ' . $i,
                'product_title_bengali'         => 'পন্যের নাম ' . $i,
                'product_slug'                  => 'outside-product-title-' . $i . 'পন্যের-নাম-' . $i,
                'product_description'           => $description,
                'product_description_bengali'   => $description_bengali,
                'product_description_short'     => $description,
                'product_categories'            => '',
                'product_keywords'              => 'sohoj, bazaar, grocery, online, eshop',
                'product_unit_name'             => 'Piece',
                'product_unit_quantity'         => 1,
                'product_unit_cost'             => 150,
                'product_unit_mrp'              => 185,
                'product_available_sizes'       => convertArrayToString(['S', 'M', 'L']),
                'product_available_colors'      => convertArrayToString(['Red', 'White', 'Black']),
                'product_discount_amount'       => 20.00,
                'product_discount_percentage'   => null,
                'product_units_in_stock'        => 100,
                'product_unit_subtract_on_order'=> true,
                'product_rank'                  => 0.00,
                'product_availability_status'   => 'In Stock',
                'product_replacement_available' => false,
                'product_guarantee_time'        => '',
                'product_guarantee_status'      => '',
                'product_active'                => true,
                'product_featured'              => false,
                'product_offered'               => true,
                'product_discounted'            => false,
                'product_available_outside'     => true,
                'product_total_unit_sold'       => 0,
                'product_img_main'              => '',
                'product_img_2'                 => '',
                'product_img_3'                 => '',
                'product_img_4'                 => '',
                'product_img_5'                 => '',
                'product_logs'                  => $log,
                'created_at'                    => \Carbon\Carbon::now(),
                'updated_at'                    => \Carbon\Carbon::now()
            ]);
        }
    }
}
