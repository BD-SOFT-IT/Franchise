<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('client_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('mobile', 15)->unique()->nullable();
            $table->string('mobile_secondary', 15)->nullable();
            $table->string('password')->nullable();
            $table->string('blood_group', 15)->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_id')->unique()->nullable();
            $table->string('img_url')->nullable();
            $table->string('billing_address', 120)->nullable();
            $table->string('billing_area', 80)->nullable();
            $table->string('billing_city', 30)->nullable();
            $table->string('billing_state', 30)->nullable();
            $table->string('billing_country', 30)->nullable();
            $table->integer('billing_postcode')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('verification_code')->nullable();
            $table->boolean('active')->default(true);
            $table->unsignedInteger('app_api_agent')->nullable(); // web_d or web_m or android or ios
            $table->longText('settings')->nullable();
            $table->longText('log')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('clients');
    }
}
