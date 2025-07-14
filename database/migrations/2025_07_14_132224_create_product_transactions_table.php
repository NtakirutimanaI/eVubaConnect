<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_transactions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('client_id');

            $table->decimal('quantity', 10, 2);
            $table->decimal('price', 12, 2);
            $table->decimal('total', 12, 2);

            $table->enum('transaction_type', ['sale', 'return']);
            $table->enum('status', ['pending', 'delivered', 'cancelled', 'returned'])->default('pending');

            $table->text('notes')->nullable();

            $table->timestamps();

            // Foreign keys
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_transactions');
    }
};
