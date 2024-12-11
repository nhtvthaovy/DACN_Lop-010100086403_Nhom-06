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
        Schema::create('tbl_order', function (Blueprint $table) {
            $table->increments('order_id');
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('shipping_id');
            $table->unsignedInteger('payment_id');
            $table->string('order_total');
            $table->enum('order_status', ['pending', 'packaged', 'shipping', 'completed','cancelled'])->default('pending');
            $table->timestamps();
        
            // Khóa ngoại cho cột customer_id
            $table->foreign('customer_id')->references('customer_id')->on('tbl_customers')->onDelete('cascade');

            // Khóa ngoại cho cột shipping_id
            $table->foreign('shipping_id')->references('shipping_id')->on('tbl_shipping')->onDelete('cascade');

            // Khóa ngoại cho cột payment_id
            $table->foreign('payment_id')->references('payment_id')->on('tbl_payment')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_order');
    }
};

