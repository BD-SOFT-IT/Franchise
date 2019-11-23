<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefusedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refused_products', function (Blueprint $table) {
            $table->increments('rp_id');
            $table->unsignedInteger('rp_product_id');
            $table->unsignedInteger('rp_admin_id');
            $table->string('rp_type', 55); // returned or damaged
            $table->unsignedDecimal('rp_product_unit_cost');
            $table->unsignedSmallInteger('rp_product_total_unit');
            $table->unsignedInteger('rp_order_id')->nullable();
            $table->string('rp_note', 1024)->nullable();
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
        Schema::dropIfExists('refused_products');
    }
}
