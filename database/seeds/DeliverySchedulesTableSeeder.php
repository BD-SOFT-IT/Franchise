<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DeliverySchedulesTableSeeder extends Seeder
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
            'time'        => Carbon::now()->format('jS M Y, h:i A')
        ], null, true);

        DB::table('delivery_schedules')->insert([
            'schedule_expected_time_from'   => Carbon::createFromTime(6),
            'schedule_expected_time_to'     => Carbon::createFromTime(7),
            'schedule_time_range_bengali'   => 'সকাল ০৬ঃ০০ - সকাল ০৭ঃ০০',
            'schedule_expected_hour_from'   => 6,
            'schedule_expected_hour_to'     => 9,
            'schedule_log'                  => $log,
            'created_at'                    => Carbon::now(),
            'updated_at'                    => Carbon::now()
        ]);

        DB::table('delivery_schedules')->insert([
            'schedule_expected_time_from'   => Carbon::createFromTime(7),
            'schedule_expected_time_to'     => Carbon::createFromTime(8),
            'schedule_time_range_bengali'   => 'সকাল ০৭ঃ০০ - সকাল ০৮ঃ০০',
            'schedule_expected_hour_from'   => 6,
            'schedule_expected_hour_to'     => 9,
            'schedule_log'                  => $log,
            'created_at'                    => Carbon::now(),
            'updated_at'                    => Carbon::now()
        ]);

        DB::table('delivery_schedules')->insert([
            'schedule_expected_time_from'   => Carbon::createFromTime(8),
            'schedule_expected_time_to'     => Carbon::createFromTime(9),
            'schedule_time_range_bengali'   => 'সকাল ০৮ঃ০০ - সকাল ০৯ঃ০০',
            'schedule_expected_hour_from'   => 6,
            'schedule_expected_hour_to'     => 9,
            'schedule_log'                  => $log,
            'created_at'                    => Carbon::now(),
            'updated_at'                    => Carbon::now()
        ]);

        DB::table('delivery_schedules')->insert([
            'schedule_expected_time_from'   => Carbon::createFromTime(9),
            'schedule_expected_time_to'     => Carbon::createFromTime(10),
            'schedule_time_range_bengali'   => 'সকাল ০৯ঃ০০ - সকাল ১০ঃ০০',
            'schedule_expected_hour_from'   => 6,
            'schedule_expected_hour_to'     => 9,
            'schedule_log'                  => $log,
            'created_at'                    => Carbon::now(),
            'updated_at'                    => Carbon::now()
        ]);

        DB::table('delivery_schedules')->insert([
            'schedule_expected_time_from'   => Carbon::createFromTime(10),
            'schedule_expected_time_to'     => Carbon::createFromTime(11),
            'schedule_time_range_bengali'   => 'সকাল ১০ঃ০০ - সকাল ১১ঃ০০',
            'schedule_expected_hour_from'   => 6,
            'schedule_expected_hour_to'     => 9,
            'schedule_log'                  => $log,
            'created_at'                    => Carbon::now(),
            'updated_at'                    => Carbon::now()
        ]);

        DB::table('delivery_schedules')->insert([
            'schedule_expected_time_from'   => Carbon::createFromTime(11),
            'schedule_expected_time_to'     => Carbon::createFromTime(12),
            'schedule_time_range_bengali'   => 'সকাল ১১ঃ০০ - দুপুর ১২ঃ০০',
            'schedule_expected_hour_from'   => 6,
            'schedule_expected_hour_to'     => 9,
            'schedule_log'                  => $log,
            'created_at'                    => Carbon::now(),
            'updated_at'                    => Carbon::now()
        ]);

        DB::table('delivery_schedules')->insert([
            'schedule_expected_time_from'   => Carbon::createFromTime(16),
            'schedule_expected_time_to'     => Carbon::createFromTime(17),
            'schedule_time_range_bengali'   => 'দুপুর ০৪ঃ০০ - বিকাল ০৫ঃ০০',
            'schedule_expected_hour_from'   => 6,
            'schedule_expected_hour_to'     => 9,
            'schedule_log'                  => $log,
            'created_at'                    => Carbon::now(),
            'updated_at'                    => Carbon::now()
        ]);

        DB::table('delivery_schedules')->insert([
            'schedule_expected_time_from'   => Carbon::createFromTime(17),
            'schedule_expected_time_to'     => Carbon::createFromTime(18),
            'schedule_time_range_bengali'   => 'বিকাল ০৫ঃ০০ - সন্ধ্যা ০৬ঃ০০',
            'schedule_expected_hour_from'   => 6,
            'schedule_expected_hour_to'     => 9,
            'schedule_log'                  => $log,
            'created_at'                    => Carbon::now(),
            'updated_at'                    => Carbon::now()
        ]);

        DB::table('delivery_schedules')->insert([
            'schedule_expected_time_from'   => Carbon::createFromTime(18),
            'schedule_expected_time_to'     => Carbon::createFromTime(19),
            'schedule_time_range_bengali'   => 'সন্ধ্যা ০৬ঃ০০ - সন্ধ্যা ০৭ঃ০০',
            'schedule_expected_hour_from'   => 6,
            'schedule_expected_hour_to'     => 9,
            'schedule_log'                  => $log,
            'created_at'                    => Carbon::now(),
            'updated_at'                    => Carbon::now()
        ]);

        DB::table('delivery_schedules')->insert([
            'schedule_expected_time_from'   => Carbon::createFromTime(19),
            'schedule_expected_time_to'     => Carbon::createFromTime(20),
            'schedule_time_range_bengali'   => 'সন্ধ্যা ০৭ঃ০০ - রাত ০৮ঃ০০',
            'schedule_expected_hour_from'   => 6,
            'schedule_expected_hour_to'     => 9,
            'schedule_log'                  => $log,
            'created_at'                    => Carbon::now(),
            'updated_at'                    => Carbon::now()
        ]);

        DB::table('delivery_schedules')->insert([
            'schedule_expected_time_from'   => Carbon::createFromTime(20),
            'schedule_expected_time_to'     => Carbon::createFromTime(21),
            'schedule_time_range_bengali'   => 'রাত ০৮ঃ০০ - রাত ০৯ঃ০০',
            'schedule_expected_hour_from'   => 6,
            'schedule_expected_hour_to'     => 9,
            'schedule_log'                  => $log,
            'created_at'                    => Carbon::now(),
            'updated_at'                    => Carbon::now()
        ]);

        DB::table('delivery_schedules')->insert([
            'schedule_expected_time_from'   => null,
            'schedule_expected_time_to'     => null,
            'schedule_expected_hour_from'   => 12,
            'schedule_expected_hour_to'     => 36,
            'schedule_log'                  => $log,
            'created_at'                    => Carbon::now(),
            'updated_at'                    => Carbon::now()
        ]);

        DB::table('delivery_schedules')->insert([
            'schedule_expected_time_from'   => null,
            'schedule_expected_time_to'     => null,
            'schedule_expected_hour_from'   => 12,
            'schedule_expected_hour_to'     => 72,
            'schedule_log'                  => $log,
            'created_at'                    => Carbon::now(),
            'updated_at'                    => Carbon::now()
        ]);

        DB::table('delivery_schedules')->insert([
            'schedule_expected_time_from'   => null,
            'schedule_expected_time_to'     => null,
            'schedule_expected_hour_from'   => 48,
            'schedule_expected_hour_to'     => 120,
            'schedule_log'                  => $log,
            'created_at'                    => Carbon::now(),
            'updated_at'                    => Carbon::now()
        ]);
    }
}
