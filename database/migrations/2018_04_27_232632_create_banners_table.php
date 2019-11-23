<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('banner_id');
            $table->integer('banner_creator_id');
            $table->string('banner_name', 55)->unique();
            $table->string('banner_type', 55)->default('image'); // image or script
            $table->string('banner_position', 55);
            $table->string('banner_title', 55)->nullable();
            $table->string('banner_description', 255)->nullable();
            $table->string('banner_img', 512)->nullable();
            $table->string('banner_target_text', 55)->nullable();
            $table->longText('banner_code')->nullable();
            $table->string('banner_provider')->nullable();
            $table->string('banner_target_url', 512)->nullable();
            $table->string('banner_target_url_type', 55)->nullable(); // internal or external
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
        Schema::dropIfExists('banners');
    }
}
