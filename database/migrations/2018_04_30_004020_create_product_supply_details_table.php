<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSupplyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_supply_details', function (Blueprint $table) {
            $table->increments('psd_id');
            $table->unsignedInteger('psd_ps_id');
            $table->string('psd_sku', 10);
            $table->string('psd_unit', 15);
            $table->unsignedDecimal('psd_quantity_per_unit', 6, 2);
            $table->unsignedDecimal('psd_unit_price', 7, 2);
            $table->unsignedDecimal('psd_unit_mrp', 7, 2);
            $table->string('psd_size')->nullable();
            $table->string('psd_color')->nullable();
            $table->unsignedDecimal('psd_discount', 5, 2)->default(0.00);
            $table->unsignedDecimal('psd_total_price', 9, 2);
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
        Schema::dropIfExists('product_supply_details');
    }
}
