<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SiteOptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('site_options')->insert([
            'so_modifier_id'    => 1,
            'so_name'           => 'site_title',
            'so_content'        => 'BD SOFT IT',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now()
        ]);

        DB::table('site_options')->insert([
            'so_modifier_id'    => 1,
            'so_name'           => 'site_description',
            'so_content'        => 'A Creative Software Company',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now()
        ]);

        DB::table('site_options')->insert([
            'so_modifier_id'    => 1,
            'so_name'           => 'site_logo',
            'so_content'        => '1565552629_ecommerce-logo-png.png',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now()
        ]);

        DB::table('site_options')->insert([
            'so_modifier_id'    => 1,
            'so_name'           => 'site_mobile',
            'so_content'        => '1400883400',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now()
        ]);

        DB::table('site_options')->insert([
            'so_modifier_id'    => 1,
            'so_name'           => 'site_email',
            'so_content'        => 'info@bdsoftit.com',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now()
        ]);

        DB::table('site_options')->insert([
            'so_modifier_id'    => 1,
            'so_name'           => 'site_keywords',
            'so_content'        => 'online grocery, online grocery bangladesh, online grocery bd, online grocery dhaka, online grocery shopping, online grocery store, online supermarket, buy groceries online, online vegetable store, food shopping online, buy fish online, buy meat online',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now()
        ]);

        DB::table('site_options')->insert([
            'so_modifier_id'    => 1,
            'so_name'           => 'map_address',
            'so_content'        => 'https://goo.gl/maps/Q8yCb5AMYn5sTY5E9',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now()
        ]);

        DB::table('site_options')->insert([
            'so_modifier_id'    => 1,
            'so_name'           => 'site_address',
            'so_content'        => 'B/3, Zakir Hossain Road, Mohammadpur, Dhaka-1207',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now()
        ]);

    }
}
