<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('tbl_reply', function (Blueprint $table) {
            $table->increments('reply_id');
            $table->unsignedInteger('review_id');
            $table->unsignedInteger('admin_id'); 
            $table->text('reply'); 
            $table->timestamps();

            $table->foreign('review_id')->references('review_id')->on('tbl_review')->onDelete('cascade');
            $table->foreign('admin_id')->references('admin_id')->on('tbl_admin')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('tbl_reply');
    }
};
