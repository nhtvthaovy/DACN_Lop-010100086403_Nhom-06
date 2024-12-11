<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Thực thi migration.
     */
    public function up(): void
    {
        Schema::create('tbl_review', function (Blueprint $table) {
            $table->increments('review_id');

            $table->unsignedInteger('product_id');
            $table->unsignedInteger('customer_id');
            $table->unsignedTinyInteger('rating');
            $table->text('comment');
            $table->boolean('review_status')->default(false); 
            $table->timestamps();
        
            $table->foreign('product_id')->references('product_id')->on('tbl_product')->onDelete('cascade');
            $table->foreign('customer_id')->references('customer_id')->on('tbl_customers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_review');
    }
};

