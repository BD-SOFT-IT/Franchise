<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_points', function (Blueprint $table) {
            $table->increments('mp_id');
            $table->unsignedInteger('mp_membership_id');
            $table->string('mp_order_no', 10)->nullable(); // If points credited
            $table->string('mp_type', 10)->defaul('credit'); // credit or debit
            $table->unsignedDecimal('mp_exchanged', 6, 2); // credited points amount or debited points amount
            $table->unsignedDecimal('mp_total', 6, 2); // total points
            $table->timestamp('created_at');

            $table->foreign('mp_membership_id')->references('membership_id')->on('memberships');
            $table->foreign('mp_order_no')->references('order_no')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membership_points');
    }
}
