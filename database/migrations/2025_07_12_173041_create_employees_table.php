<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');               // Primary key, auto-increment bigint
            $table->string('name');                     // Employee full name, required
            $table->string('position')->nullable();    // Job title/role, optional
            $table->string('email')->unique()->nullable(); // Email, optional and unique
            $table->boolean('status')->default(1);     // Active/inactive status, default active
            $table->string('expertise')->nullable(); 
            $table->timestamps();                       // created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
