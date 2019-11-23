<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('order_id');
            $table->string('order_no', 10)->unique();
            $table->unsignedInteger('order_client_id')->nullable();
            $table->string('order_for_franchise', 10)->nullable();
            $table->string('order_by_franchise', 10)->nullable();
            $table->dateTime('order_shipping_datetime')->nullable();
            //$table->string('order_shipping_type', 55);
            //$table->unsignedDecimal('order_shipping_fees', 6, 2)->default(0.00);
            $table->unsignedInteger('order_shipping_method')->nullable();
            $table->unsignedInteger('order_shipper_id')->nullable();
            $table->string('order_shipping_person', 120);
            $table->string('order_shipping_phone', 20);
            $table->string('order_shipping_address', 120);
            $table->string('order_shipping_area', 55);
            $table->string('order_shipping_city', 30);
            $table->string('order_shipping_state', 30);
            $table->string('order_shipping_country', 30)->default('Bangladesh');
            $table->unsignedSmallInteger('order_shipping_postcode')->nullable();
            $table->unsignedDecimal('order_vat', 6, 2)->default(0.00);
            $table->unsignedDecimal('order_products_total', 15, 2);
            $table->unsignedDecimal('order_coupon_code_discount', 15, 2)->nullable();
            $table->unsignedDecimal('order_total', 15, 2);
            $table->unsignedDecimal('order_total_paid_with_account', 7, 2)->default(0.00);
            $table->unsignedDecimal('order_total_due', 15, 2);
            $table->string('order_payment_type', 55);
            $table->string('order_payment_status', 25)->default('due');
            $table->string('order_progress', 25)->default('pending');
            $table->string('order_secret')->nullable();
            $table->string('order_created_by', 50)->default('web');
            $table->text('order_log')->nullable();
            $table->string('order_note', 512 )->nullable();
            $table->timestamps();

            $table->foreign('order_client_id')->references('client_id')->on('clients');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
