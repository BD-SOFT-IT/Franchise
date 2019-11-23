<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->insert([
            'banner_creator_id'     => 1,
            'banner_name'           => 'index_top_banner',
            'banner_type'           => 'image',
            'banner_position'       => 'index-top-main',
            'banner_title'          => 'Index Top Banner',
            'banner_description'    => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
            'banner_img'            => null,
            'banner_target_text'    => null,
            'banner_provider'       => 'Own',
            'banner_target_url'     => null,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);

        // Index Sliders
        for($i = 1; $i <= 5; $i++) {

            DB::table('banners')->insert([
                'banner_creator_id'     => 1,
                'banner_name'           => 'index_main_slider_' . $i,
                'banner_type'           => 'image',
                'banner_position'       => 'index-main-slider',
                'banner_title'          => 'Index Main Slider ' . $i,
                'banner_description'    => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'banner_img'            => null,
                'banner_target_text'    => ($i <= 3) ? 'Shop Now' : 'Book Now',
                'banner_provider'       => ($i <= 3) ? 'SohojBazaar' : 'FaceBook',
                'banner_target_url'     => ($i <= 3) ? '#' : 'https://fb.com/SohojBazaar',
                'banner_target_url_type'=> ($i <= 3) ? 'internal' : 'external',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now()
            ]);
        }

        // Index Top Mobile
        DB::table('banners')->insert([
            'banner_creator_id'     => 1,
            'banner_name'           => 'index_top_mobile',
            'banner_type'           => 'image',
            'banner_position'       => 'index-top-mobile',
            'banner_title'          => 'Index Top Mobile',
            'banner_description'    => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
            'banner_img'            => null,
            'banner_target_text'    => null,
            'banner_provider'       => 'Google',
            'banner_target_url'     => 'https://play.google.com',
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);
    }
}
