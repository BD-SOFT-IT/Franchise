<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientAccountBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_account_balances', function (Blueprint $table) {
            $table->increments('cab_id');
            $table->unsignedInteger('cab_client_id');
            $table->unsignedDecimal('cab_debited', 7, 2)->nullable();
            $table->string('cab_debited_by')->nullable(); // order or membership card
            $table->unsignedInteger('cab_debited_by_order_id')->nullable();
            $table->unsignedDecimal('cab_credited', 7, 2)->nullable();
            $table->string('cab_credited_by')->nullable(); // referral or membership point or user payment
            $table->unsignedInteger('cab_credited_by_coupon_code')->nullable();
            $table->unsignedInteger('cab_credited_by_membership_point_id')->nullable();
            $table->unsignedInteger('cab_credited_by_payment_id')->nullable();
            $table->unsignedDecimal('cab_balance', 7, 2)->default(0.00);
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
        Schema::dropIfExists('client_account_balances');
    }
}
