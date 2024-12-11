<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_product', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('product_name');
            $table->unsignedInteger('category_id')->nullable();
            $table->text('product_desc')->nullable();
            $table->text('product_content')->nullable();
            $table->string('product_price');
            $table->string('product_image');
            $table->boolean('product_status');
            $table->string('product_quantity');
            $table->string('product_sold')->default('0');

            $table->timestamps();

            $table->foreign('category_id')
                ->references('category_id')
                ->on('tbl_category_product')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_product');
    }
};
