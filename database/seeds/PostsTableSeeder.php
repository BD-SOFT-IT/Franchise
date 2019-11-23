<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = ['About Us', 'Privacy Policy', 'Shipping & Returns', 'Delivery Information', 'Secure Shopping', 'Terms & Conditions', 'Frequently Asked Questions (FAQ)'];
        $slugs = ['about-us', 'privacy-policy', 'shipping-and-returns', 'delivery-information', 'secure-shopping', 'terms-and-conditions', 'frequently-asked-questions'];

        foreach ($titles as $index => $title) {
            DB::table('posts')->insert([
                'post_admin_id'         => 1,
                'post_title'            => $title,
                'post_slug'             => $slugs[$index],
                'post_keywords'         => '',
                'post_meta_description' => '',
                'post_description'      => '',
                'post_active'           => 1,
                'post_type'             => 'page',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now()
            ]);
        }
    }
}
