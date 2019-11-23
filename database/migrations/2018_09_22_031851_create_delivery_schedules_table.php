<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliverySchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_schedules', function (Blueprint $table) {
            $table->increments('schedule_id');
            $table->time('schedule_expected_time_from')->nullable();
            $table->time('schedule_expected_time_to')->nullable();
            $table->string('schedule_time_range_bengali')->nullable();
            $table->unsignedDecimal('schedule_expected_hour_from', 5, 2)->nullable(); // Expected delivery Period From - in Hour(s)
            $table->unsignedDecimal('schedule_expected_hour_to', 5, 2)->nullable(); // Expected delivery Period To - in Hour(s)
            $table->text('schedule_log');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_schedules');
    }
}
