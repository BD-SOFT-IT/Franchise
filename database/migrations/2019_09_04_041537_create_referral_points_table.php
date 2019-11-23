<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferralPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_points', function (Blueprint $table) {
            $table->increments('point_id');
            $table->unsignedInteger('point_client')->unique();
            $table->unsignedInteger('point_value')->default(0);
            $table->longText('point_log')->nullable();
            $table->timestamps();

            $table->foreign('point_client')->on('clients')->references('client_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referral_points');
    }
}
