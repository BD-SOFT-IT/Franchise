<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingBagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_bags', function (Blueprint $table) {
            $table->unsignedInteger('sb_id');
            $table->unsignedInteger('sb_client_id');
            $table->timestamps();

            $table->primary('sb_id');
            $table->foreign('sb_client_id')->references('client_id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shopping_bags');
    }
}
