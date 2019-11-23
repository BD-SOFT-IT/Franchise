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
            $table->string('product_title',30);
            $table->string('product_description',1200);
            $table->string('product_category');
            $table->integer('product_unit');
            $table->integer('product_unit_cost')->nullable();
            $table->integer('product_unit_mrp');
            $table->integer('product_unit_stock');
            $table->string('product_unit_availability')->default('no');
            $table->string('product_vendor_name',20);
            $table->string('product_image_path')->nullable();
            $table->integer('product_discount')->nullable();
            $table->integer('product_vat')->nullable();
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
