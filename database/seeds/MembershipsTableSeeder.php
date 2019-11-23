<?php

use Illuminate\Database\Seeder;

class MembershipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $new_log = [
            'type'          => 'created',
            'author_id'     => 1,
            'author_name'   => 'Jonson Bhowmik',
            'time'          => \Carbon\Carbon::now()
        ];

        $log = makeNewLog($new_log, null, true);

        // Seed Membership data
        for($i = 1; $i <= 1000; $i++) {
            DB::table('memberships')->insert([
                'membership_id'     => 1000700000 + $i,
                'membership_log'    => $log,
                'created_at'        => \Carbon\Carbon::now(),
                'updated_at'        => \Carbon\Carbon::now()
            ]);
        }
    }
}
