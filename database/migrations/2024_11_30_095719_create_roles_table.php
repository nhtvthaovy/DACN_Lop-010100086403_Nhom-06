<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        Schema::create('tbl_roles', function (Blueprint $table) {
            $table->increments('role_id');
            $table->string('name')->unique();  
        });


        DB::table('tbl_roles')->insert([
            ['name' => 'owner'],     
            ['name' => 'admin'],    
            ['name' => 'moderator'],  
            ['name' => 'user'],      
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_roles');
    }
};
