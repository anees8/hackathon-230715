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
        Schema::create('skus', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Product name
            $table->text('description')->nullable(); // Product description
            $table->string('image')->nullable(); // Path to the product image
            $table->string('sku_code'); // SKU code for reference
            $table->decimal('price', 8, 2);     // SKU price in INR 
            $table->foreignId('size_id')->constrained('sizes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('product_type_id')->constrained('product_types')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skus');
    }
};
