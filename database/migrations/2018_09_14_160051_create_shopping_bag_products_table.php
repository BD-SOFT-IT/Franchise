<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingBagProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_bag_products', function (Blueprint $table) {
            $table->increments('sbp_id');
            $table->unsignedInteger('sbp_shopping_bag_id');
            $table->unsignedInteger('sbp_product_id');
            $table->unsignedTinyInteger('sbp_product_total_unit');
            $table->timestamps();

            $table->foreign('sbp_shopping_bag_id')->references('sb_id')->on('shopping_bags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shopping_bag_products');
    }
}
