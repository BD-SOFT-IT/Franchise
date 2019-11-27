<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellerProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_products', function (Blueprint $table) {
            $table->bigIncrements('product_id');
            $table->string('product_name')->unique();
            $table->string('product_brand');
            $table->string('product_category');
            $table->string('product_code')->unique();
            $table->integer('product_unit_cost');
            $table->integer('product_unit_mrp');
            $table->integer('product_unit_stock');
            $table->string('product_description');
            $table->string('product_availability');
            $table->string('product_feature')->default('no')->nullable();
            $table->string('product_color')->nullable();
            $table->string('product_size')->nullable();
            $table->integer('product_discount')->nullable();
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
        Schema::dropIfExists('seller_products');
    }
}
