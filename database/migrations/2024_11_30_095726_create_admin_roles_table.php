<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_admin_roles', function (Blueprint $table) {
            $table->unsignedInteger('admin_id');
            $table->unsignedInteger('role_id'); 
            $table->timestamps();
        

            $table->foreign('admin_id')->references('admin_id')->on('tbl_admin')->onDelete('cascade');
            $table->foreign('role_id')->references('role_id')->on('tbl_roles')->onDelete('cascade');
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_admin_roles');
    }
};
