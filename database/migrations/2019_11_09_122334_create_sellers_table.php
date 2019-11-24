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
            $table->string('seller_first_name');
            $table->string('seller_last_name');
            $table->string('seller_email')->unique();
            $table->string('type_of_seller');
            $table->string('shop_name')->unique();
            $table->string('shop_address');
            $table->string('shop_road_number');
            $table->string('shop_district');
            $table->string('shop_url');
            $table->string('shop_identity');
            $table->string('seller_password');
            $table->string('seller_number');
            $table->string('seller_alt_number');
            $table->string('seller_terms_conditions');
            $table->string('email_verify_at')->nullable();
            $table->string('verification_code')->nullable();
            $table->tinyInteger('is_active')->default('0');
            $table->tinyInteger('is_blocked')->default('1');
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
