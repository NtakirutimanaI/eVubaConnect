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
    Schema::create('inventory_logs', function (Blueprint $table) {
    $table->id();
    $table->foreignId('inventory_id')->constrained()->onDelete('cascade');
    $table->enum('type', ['in', 'out']);
    $table->integer('quantity');
    $table->foreignId('performed_by')->constrained('users')->onDelete('cascade');
    $table->text('note')->nullable();
    $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_inventory_logs');
    }
};
