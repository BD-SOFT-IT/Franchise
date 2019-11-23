<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('supplier_id');
            $table->string('supplier_name', 100);
            $table->string('supplier_contact_name', 100);
            $table->string('supplier_contact_title', 100);
            $table->string('supplier_address_1', 255)->nullable();
            $table->string('supplier_address_2', 255)->nullable();
            $table->string('supplier_city', 55)->nullable();
            $table->unsignedSmallInteger('supplier_postcode')->nullable();
            $table->string('supplier_country', 55)->nullable();
            $table->string('supplier_phone', 15)->nullable();
            $table->string('supplier_phone_alt', 15)->nullable();
            $table->string('supplier_contact_phone', 15);
            $table->string('supplier_fax', 25)->nullable();
            $table->string('supplier_email', 25)->nullable();
            $table->string('supplier_web')->nullable();
            $table->string('supplier_payment_method')->default('Pay After Delivery');
            $table->unsignedInteger('supplier_products_category_id');
            $table->string('supplier_note', 255)->nullable();
            $table->string('supplier_logo', 512)->nullable();
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
        Schema::dropIfExists('suppliers');
    }
}
