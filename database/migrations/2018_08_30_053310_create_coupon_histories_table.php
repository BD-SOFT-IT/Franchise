<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_histories', function (Blueprint $table) {
            $table->increments('ch_id');
            $table->unsignedInteger('ch_client_id');
            $table->string('ch_coupon_code', 15);
            $table->unsignedInteger('ch_used_order_id')->nullable();
            $table->timestamp('ch_used_at');

            $table->foreign('ch_client_id')->references('client_id')->on('clients');
            $table->foreign('ch_coupon_code')->references('coupon_code')->on('coupons');
            $table->foreign('ch_used_order_id')->references('order_id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupon_histories');
    }
}
