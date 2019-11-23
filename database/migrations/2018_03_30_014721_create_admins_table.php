<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('franchise_id', 10)->unique()->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('img_url')->nullable();
            $table->string('address', 80)->nullable();
            $table->string('city', 30)->nullable();
            $table->string('country', 30)->nullable();
            $table->integer('postcode')->nullable();
            $table->string('mobile_primary', 15)->nullable();
            $table->string('mobile_secondary', 15)->nullable();
            $table->unsignedInteger('role_id');
            $table->boolean('active')->default(0);
            $table->integer('creator_id')->nullable();
            $table->rememberToken();
            $table->timestamps();


            $table->foreign('role_id')->references('ar_id')->on('admin_roles')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
