<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('od_id');
            $table->unsignedInteger('od_order_id');
            $table->unsignedInteger('od_product_id');
            $table->string('od_product_size')->nullable();
            $table->string('od_product_color')->nullable();
            $table->unsignedDecimal('od_product_unit_cost', 15, 2);
            $table->unsignedDecimal('od_product_unit_mrp', 15, 2);
            $table->unsignedInteger('od_product_quantity');
            $table->unsignedDecimal('od_product_discount_amount', 15, 2)->nullable();
            $table->unsignedDecimal('od_product_discount_percentage', 4, 2)->nullable();
            $table->unsignedDecimal('od_product_total', 15, 2);
            $table->timestamps();


            $table->foreign('od_order_id')->references('order_id')->on('orders');
            $table->foreign('od_product_id')->references('product_id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
