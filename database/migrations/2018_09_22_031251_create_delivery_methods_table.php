<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_methods', function (Blueprint $table) {
            $table->increments('method_id');
            $table->string('method_name');
            $table->float('method_charge', 6, 2);
            $table->boolean('method_available_outside')->default(false);
            $table->boolean('method_active')->default(true);
            $table->string('method_time')->nullable();
            $table->string('method_note')->nullable();
            $table->longText('method_log')->nullable();
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
        Schema::dropIfExists('delivery_methods');
    }
}
