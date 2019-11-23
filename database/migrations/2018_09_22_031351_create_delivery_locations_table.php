<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_locations', function (Blueprint $table) {
            $table->increments('location_id');
            $table->unsignedInteger('location_admin_id');
            $table->string('location_type'); // 'country' or 'state' (division) or 'city' (districts) or area (Local Area)
            $table->string('location_name');
            $table->string('location_name_bengali');
            $table->unsignedInteger('location_parent')->nullable();
            $table->boolean('location_selected')->default(0);
            $table->text('location_log');
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
        Schema::dropIfExists('delivery_locations');
    }
}
