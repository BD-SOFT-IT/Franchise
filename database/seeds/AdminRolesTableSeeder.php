<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AdminRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = ['Super Admin', 'Admin', 'Manager', 'Customer Manager', 'Store Keeper', 'Shipper', 'Alpha', 'Franchise'];
        $names = ['super_admin', 'admin', 'manager', 'customer_manager', 'store_keeper', 'shipper', 'alpha', 'franchise'];

        for($i = 0; $i < count($titles); $i++) {
            DB::table('admin_roles')->insert([
                'ar_title'         => $titles[$i],
                'ar_name'          => $names[$i],
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ]);
        }
    }
}
