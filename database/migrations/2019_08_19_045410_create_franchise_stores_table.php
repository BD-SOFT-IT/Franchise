<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFranchiseStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('franchise_stores', function (Blueprint $table) {
            $table->bigIncrements('fs_id');
            $table->unsignedInteger('fs_product_id');
            $table->unsignedInteger('fs_admin_id');
            $table->integer('fs_stock')->default(0);
            $table->text('fs_sizes')->nullable();
            $table->text('fs_colors')->nullable();
            $table->longText('fs_log')->nullable();
            $table->timestamps();

            $table->foreign('fs_product_id')->on('products')->references('product_id');
            $table->foreign('fs_admin_id')->on('admins')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('franchise_stores');
    }
}
