<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_brands', function (Blueprint $table) {
            $table->increments('pb_id');
            $table->string('pb_name')->unique();
            $table->string('pb_name_bengali')->nullable();
            $table->string('pb_img')->nullable();
            $table->string('pb_website')->nullable();
            $table->string('pb_phone')->nullable();
            $table->string('pb_email')->nullable();
            $table->text('pb_log')->nullable();
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
        Schema::dropIfExists('product_brands');
    }
}
