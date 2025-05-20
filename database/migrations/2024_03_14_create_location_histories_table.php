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
        Schema::create('location_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employees_id')->constrained('employees');
            $table->string('latitude', 45);
            $table->string('longitude', 45);
            $table->string('accuracy', 45)->nullable();
            $table->string('speed', 45)->nullable();
            $table->string('heading', 45)->nullable();
            $table->string('altitude', 45)->nullable();
            $table->string('altitude_accuracy', 45)->nullable();
            $table->string('timestamp', 45);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_histories');
    }
}; 