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
        Schema::create('tailor_product_type', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tailor_id');
            $table->unsignedBigInteger('product_type_id');
            $table->timestamps();
            // Add foreign key constraints
            $table->foreign('tailor_id')->references('id')->on('tailors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_type_id')->references('id')->on('product_types')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tailor_product_type');
    }
};
