<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('product_sku', 15)->unique();
            $table->unsignedInteger('product_vendor')->nullable();
            $table->string('product_vendor_sku')->nullable();
            $table->string('product_title');
            $table->string('product_title_bengali')->nullable();
            $table->string('product_slug')->unique();
            $table->longText('product_description');
            $table->longText('product_description_bengali')->nullable();
            $table->text('product_description_app')->nullable();
            $table->text('product_description_bengali_app')->nullable();
            $table->string('product_categories', 1024);
            $table->string('product_description_short', 350)->nullable();
            $table->string('product_keywords')->nullable();
            $table->string('product_unit_name', 15);
            $table->unsignedDecimal('product_unit_quantity', 10, 2);
            $table->unsignedDecimal('product_unit_cost', 15, 2);
            $table->unsignedDecimal('product_unit_mrp', 15, 2);
            $table->unsignedDecimal('product_unit_mrp_franchise', 15, 2)->nullable();
            $table->string('product_available_sizes', 512)->nullable();
            $table->string('product_available_colors', 512)->nullable();
            $table->unsignedDecimal('product_discount_amount', 15, 2)->nullable();
            $table->unsignedDecimal('product_discount_percentage', 5, 2)->nullable();
            $table->unsignedInteger('product_units_in_stock')->nullable();
            $table->unsignedTinyInteger('product_units_min_franchise')->default(5);
            $table->unsignedTinyInteger('product_units_max_selection')->default(10);
            $table->boolean('product_unit_subtract_on_order')->default(0);
            $table->unsignedDecimal('product_rank', 3, 2)->default(0.00);
            $table->string('product_availability_status');
            $table->boolean('product_replacement_available')->default(0);
            $table->string('product_guarantee_time')->nullable();
            $table->string('product_guarantee_status');
            $table->boolean('product_active')->default(1);
            $table->boolean('product_featured')->default(0);
            $table->boolean('product_offered')->default(0);
            $table->boolean('product_discounted')->default(0);
            $table->boolean('product_available_outside')->default(0);
            $table->integer('product_total_unit_sold')->default(0);
            $table->string('product_img_main', 1024)->nullable();
            $table->string('product_img_2', 1024)->nullable();
            $table->string('product_img_3', 1024)->nullable();
            $table->string('product_img_4', 1024)->nullable();
            $table->string('product_img_5', 1024)->nullable();
            $table->text('product_logs')->nullable();
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
        Schema::dropIfExists('products');
    }
}
