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
        Schema::create('tailor_order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tailor_id')->nullable()->default(null)->constrained('tailors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('order_id')->nullable()->default(null)->constrained('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tailor_order');
    }
};
