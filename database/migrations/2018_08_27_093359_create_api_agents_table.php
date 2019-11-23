<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_agents', function (Blueprint $table) {
            $table->increments('agent_id');
            $table->unsignedInteger('agent_creator_id');
            $table->string('agent_api_key', 22)->unique();
            $table->string('agent_api_secret', 16);
            $table->string('agent_type');
            $table->string('agent_name')->unique();
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
        Schema::dropIfExists('api_agents');
    }
}
