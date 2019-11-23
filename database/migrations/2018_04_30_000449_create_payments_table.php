<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('payment_id');
            $table->string('payment_transaction_no');
            $table->unsignedInteger('payment_client_id');
            $table->unsignedInteger('payment_order_no');
            $table->string('payment_type', 55);
            $table->string('payment_status', 55);
            $table->string('payment_error')->nullable();
            $table->unsignedDecimal('payment_total', 7, 2);
            $table->unsignedDecimal('payment_fees', 6, 2);
            $table->timestamps();

            $table->foreign('payment_client_id')->references('client_id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
