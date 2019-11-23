<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->increments('pr_id');
            $table->unsignedInteger('pr_client_id');
            $table->unsignedInteger('pr_product_id')->nullable();
            $table->unsignedDecimal('pr_rank', 3, 2);
            $table->string('pr_comment', 1024)->nullable();
            $table->boolean('pr_active')->default(0);
            $table->unsignedInteger('pr_approved_by')->nullable();
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
        Schema::dropIfExists('product_reviews');
    }
}
