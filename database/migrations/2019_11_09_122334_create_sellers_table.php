<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->bigIncrements('seller_id');
            $table->string('seller_email')->unique();
            $table->string('seller_password');
            $table->string('seller_name',20);
            $table->string('seller_shop_name',30)->unique();
            $table->string('seller_shop_address',40);
            $table->string('seller_shop_postcode');
            $table->string('seller_shop_city');
            $table->string('seller_shop_district');
            $table->string('seller_shop_division');
            $table->string('seller_shop_identity',10);
            $table->string('seller_account_type');
            $table->string('seller_phone_number',11);
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
        Schema::dropIfExists('sellers');
    }
}
