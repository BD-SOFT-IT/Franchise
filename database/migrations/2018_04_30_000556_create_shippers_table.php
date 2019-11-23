<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippers', function (Blueprint $table) {
            $table->increments('shipper_id');
            $table->unsignedInteger('shipper_user_id')->nullable();
            $table->string('shipper_name');
            $table->string('shipper_company');
            $table->string('shipper_website')->nullable();
            $table->string('shipper_address');
            $table->string('shipper_phone');
            $table->string('shipper_phone_alt')->nullable();
            $table->string('shipper_email')->nullable();
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
        Schema::dropIfExists('shippers');
    }
}
