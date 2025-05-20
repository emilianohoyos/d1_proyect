<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('route_store', function (Blueprint $table) {
            $table->id();
            $table->foreignId('route_id')->constrained()->onDelete('cascade');
            $table->foreignId('store_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            // Índice compuesto para evitar duplicados y mejorar consultas
            $table->unique(['route_id', 'store_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('route_store');
    }
};
