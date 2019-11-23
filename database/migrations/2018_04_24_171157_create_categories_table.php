<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('category_id');
            $table->unsignedInteger('category_creator_id');
            $table->string('category_title');
            $table->string('category_title_bangla')->nullable();
            $table->string('category_description', 255);
            $table->string('category_slug', 70)->unique();
            $table->string('category_type', 11);
            $table->string('category_img')->nullable();
            $table->unsignedInteger('category_parent_id')->nullable();
            $table->boolean('category_active')->default(1);
            $table->string('category_log', 1024)->nullable();
            $table->float('category_order', 4, 2);
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
        Schema::dropIfExists('categories');
    }
}
