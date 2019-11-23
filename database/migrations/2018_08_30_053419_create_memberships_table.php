<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->unsignedInteger('membership_id');
            $table->unsignedInteger('membership_client_id')->nullable();
            $table->string('membership_type', 35)->default('silver'); // silver or gold or platinum
            $table->boolean('membership_active')->default(0);
            $table->text('membership_log');
            $table->timestamps();

            $table->primary('membership_id');
            $table->foreign('membership_client_id')->references('client_id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('memberships');
    }
}
