<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('post_id');
            $table->unsignedInteger('post_admin_id');
            $table->string('post_title');
            $table->string('post_slug')->unique();
            $table->string('post_keywords')->nullable();
            $table->string('post_meta_description', 350)->nullable();
            $table->longText('post_description')->nullable();
            $table->boolean('post_active')->default(0);
            $table->string('post_type', 25)->default('page');
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
        Schema::dropIfExists('posts');
    }
}
