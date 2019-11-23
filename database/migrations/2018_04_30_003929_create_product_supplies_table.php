<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_supplies', function (Blueprint $table) {
            $table->increments('ps_id');
            $table->unsignedInteger('ps_creator_id');
            $table->unsignedInteger('ps_supplier_id')->nullable();
            $table->unsignedDecimal('ps_total_price', 9, 2);
            $table->string('ps_payment_status', 25); // Full Paid, Full Due, Partial Paid
            $table->unsignedDecimal('ps_price_paid', 9, 2)->default(0.00);
            $table->unsignedDecimal('ps_price_due', 9, 2)->default(0.00);
            $table->boolean('ps_full_paid')->default(0);
            $table->date('ps_complete_date')->nullable();
            $table->string('ps_modifier_id_list', 300)->nullable();
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
        Schema::dropIfExists('product_supplies');
    }
}
