<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('coupon_id');
            $table->string('coupon_code', 15)->unique();
            $table->unsignedDecimal('coupon_discount_amount', 6, 2)->nullable();
            $table->unsignedDecimal('coupon_discount_percentage', 4, 2)->nullable();
            $table->unsignedDecimal('coupon_max_amount', 6, 2)->nullable();
            $table->unsignedDecimal('coupon_min_order_amount', 6, 2)->nullable();
            $table->string('coupon_type', 35); // referral or membership or promotional
            $table->unsignedInteger('coupon_referrer_id')->nullable(); // If coupon type is referral
            $table->string('coupon_note', 512)->nullable();
            $table->text('coupon_log')->nullable();
            $table->date('coupon_started');
            $table->date('coupon_expired')->nullable();
            $table->boolean('coupon_active')->default(1);
            $table->unsignedInteger('coupon_max_use_time')->nullable();
            $table->timestamps();

            $table->foreign('coupon_referrer_id')->references('client_id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
