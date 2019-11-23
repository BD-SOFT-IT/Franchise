<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'first_name'    => 'Alpha',
            'last_name'     => 'Admin',
            'name'          => 'Alpha Admin',
            'email'         => 'alpha@email.com',
            'password'      => Hash::make('11111111'),
            'img_url'       => '/images/icons/bdsoftit_icon_o.ong',
            'mobile_primary'=> '+8801712030303',
            'role_id'       => 7,
            'active'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);

        DB::table('admins')->insert([
            'first_name'    => 'Super',
            'last_name'     => 'Admin',
            'name'          => 'Super Admin',
            'email'         => 'admin@email.com',
            'password'      => Hash::make('11111111'),
            'mobile_primary'=> '+880145213546',
            'role_id'       => 1,
            'active'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);

        DB::table('admins')->insert([
            'first_name'    => 'Abir',
            'last_name'     => 'Hasan',
            'name'          => 'Abir Hasan',
            'email'         => 'abirhasan@gmail.com',
            'password'      => Hash::make('11111111'),
            'mobile_primary'=> '+8801902715824',
            'role_id'       => 3,
            'active'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);


        DB::table('admins')->insert([
            'first_name'    => 'Shakil',
            'last_name'     => 'Hasan',
            'name'          => 'Shakil Hasan',
            'email'         => 'shakilhasan@gmail.com',
            'password'      => Hash::make('11111111'),
            'mobile_primary'=> '+8801902715824',
            'role_id'       => 5,
            'active'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);

        DB::table('admins')->insert([
            'first_name'    => 'Shanto',
            'last_name'     => 'Rahman',
            'name'          => 'Shanto Rahman',
            'email'         => 'shantorahman@gmail.com',
            'password'      => Hash::make('11111111'),
            'mobile_primary'=> '+8801902715824',
            'role_id'       => 6,
            'active'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);

        DB::table('admins')->insert([
            'franchise_id'  => 'FRA123456',
            'first_name'    => 'Abdul',
            'last_name'     => 'Karim',
            'name'          => 'Abdul Karim',
            'email'         => 'abdulkarim@gmail.com',
            'password'      => Hash::make('11111111'),
            'mobile_primary'=> '+8801902715824',
            'role_id'       => 8,
            'active'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);

        DB::table('admins')->insert([
            'franchise_id'  => 'FRA123654',
            'first_name'    => 'Shofiq',
            'last_name'     => 'Islam',
            'name'          => 'Shofiq Islam',
            'email'         => 'shofiqislam@gmail.com',
            'password'      => Hash::make('11111111'),
            'mobile_primary'=> '+8801902715824',
            'role_id'       => 8,
            'active'        => 0,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
    }
}
