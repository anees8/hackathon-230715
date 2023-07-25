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
        Schema::create('tailors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('password');
            $table->text('address');
            $table->string('email')->nullable()->unique();
            $table->decimal('commission_limit', 8, 2)->default(1111);
            $table->decimal('total_commission', 8, 2)->default(0);
            $table->integer('max_units_per_day')->default(10);
            $table->decimal('daily_commission', 8, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tailors');
    }
};
