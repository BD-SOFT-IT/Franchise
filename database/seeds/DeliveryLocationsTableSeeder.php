<?php

use Illuminate\Database\Seeder;

class DeliveryLocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $log = makeNewLog([
            'content'     => 'Schedule Created',
            'author_id'   => auth('admin')->id(),
            'author_name' => 'Jonson Bhowmik',
            'time'        => \Carbon\Carbon::now()->format('jS M Y, h:i A')
        ], null, true);
        // Country
        DB::table('delivery_locations')->insert([
            'location_admin_id' => 1,
            'location_type'     => 'country',
            'location_name'     => 'Bangladesh',
            'location_name_bengali' => 'বাংলাদেশ',
            'location_parent'   => null,
            'location_log'      => $log,
            'created_at'        => \Carbon\Carbon::now(),
            'updated_at'        => \Carbon\Carbon::now()
        ]);
        // States (Divisions)
        DB::table('delivery_locations')->insert([
            'location_admin_id' => 1,
            'location_type'     => 'state',
            'location_name'     => 'Dhaka',
            'location_name_bengali' => 'ঢাকা',
            'location_parent'   => 1,
            'location_log'      => $log,
            'created_at'        => \Carbon\Carbon::now(),
            'updated_at'        => \Carbon\Carbon::now()
        ]);

        DB::table('delivery_locations')->insert([
            'location_admin_id' => 1,
            'location_type'     => 'state',
            'location_name'     => 'Chittagong',
            'location_name_bengali' => 'চট্টগ্রাম',
            'location_parent'   => 1,
            'location_log'      => $log,
            'created_at'        => \Carbon\Carbon::now(),
            'updated_at'        => \Carbon\Carbon::now()
        ]);

        DB::table('delivery_locations')->insert([
            'location_admin_id' => 1,
            'location_type'     => 'state',
            'location_name'     => 'Mymensingh',
            'location_name_bengali' => 'ময়মনসিংহ',
            'location_parent'   => 1,
            'location_log'      => $log,
            'created_at'        => \Carbon\Carbon::now(),
            'updated_at'        => \Carbon\Carbon::now()
        ]);
        // Cities (Districts)
        DB::table('delivery_locations')->insert([
            'location_admin_id' => 1,
            'location_type'     => 'city',
            'location_name'     => 'Dhaka',
            'location_name_bengali' => 'ঢাকা',
            'location_parent'   => 2,
            'location_log'      => $log,
            'created_at'        => \Carbon\Carbon::now(),
            'updated_at'        => \Carbon\Carbon::now()
        ]);

        DB::table('delivery_locations')->insert([
            'location_admin_id' => 1,
            'location_type'     => 'city',
            'location_name'     => 'Gazipur',
            'location_name_bengali' => 'গাজীপুর',
            'location_parent'   => 2,
            'location_log'      => $log,
            'created_at'        => \Carbon\Carbon::now(),
            'updated_at'        => \Carbon\Carbon::now()
        ]);

        DB::table('delivery_locations')->insert([
            'location_admin_id' => 1,
            'location_type'     => 'city',
            'location_name'     => 'Manikganj',
            'location_name_bengali' => 'মানিকগঞ্জ',
            'location_parent'   => 2,
            'location_log'      => $log,
            'created_at'        => \Carbon\Carbon::now(),
            'updated_at'        => \Carbon\Carbon::now()
        ]);

        DB::table('delivery_locations')->insert([
            'location_admin_id' => 1,
            'location_type'     => 'city',
            'location_name'     => 'Chittagong',
            'location_name_bengali' => 'চট্টগ্রাম',
            'location_parent'   => 3,
            'location_log'      => $log,
            'created_at'        => \Carbon\Carbon::now(),
            'updated_at'        => \Carbon\Carbon::now()
        ]);

        DB::table('delivery_locations')->insert([
            'location_admin_id' => 1,
            'location_type'     => 'city',
            'location_name'     => 'Cox\'s Bazar',
            'location_name_bengali' => 'কক্সবাজার',
            'location_parent'   => 3,
            'location_log'      => $log,
            'created_at'        => \Carbon\Carbon::now(),
            'updated_at'        => \Carbon\Carbon::now()
        ]);

        DB::table('delivery_locations')->insert([
            'location_admin_id' => 1,
            'location_type'     => 'city',
            'location_name'     => 'Rangamati',
            'location_name_bengali' => 'রাঙামাটি',
            'location_parent'   => 3,
            'location_log'      => $log,
            'created_at'        => \Carbon\Carbon::now(),
            'updated_at'        => \Carbon\Carbon::now()
        ]);

        DB::table('delivery_locations')->insert([
            'location_admin_id' => 1,
            'location_type'     => 'city',
            'location_name'     => 'Mymensingh',
            'location_name_bengali' => 'ময়মনসিংহ',
            'location_parent'   => 4,
            'location_log'      => $log,
            'created_at'        => \Carbon\Carbon::now(),
            'updated_at'        => \Carbon\Carbon::now()
        ]);

        DB::table('delivery_locations')->insert([
            'location_admin_id' => 1,
            'location_type'     => 'city',
            'location_name'     => 'Netrokona',
            'location_name_bengali' => 'নেত্রকোণা',
            'location_parent'   => 4,
            'location_log'      => $log,
            'created_at'        => \Carbon\Carbon::now(),
            'updated_at'        => \Carbon\Carbon::now()
        ]);

        DB::table('delivery_locations')->insert([
            'location_admin_id' => 1,
            'location_type'     => 'city',
            'location_name'     => 'Jamalpur',
            'location_name_bengali' => 'জামালপুর',
            'location_parent'   => 4,
            'location_log'      => $log,
            'created_at'        => \Carbon\Carbon::now(),
            'updated_at'        => \Carbon\Carbon::now()
        ]);
    }
}
