<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('location_histories', function (Blueprint $table) {
            $table->id();
            $table->string('latitud', 45)->nullable();
            $table->string('longitud', 45)->nullable();
            $table->timestamp('visit_date')->nullable();
            $table->integer('location_historycol')->nullable();
            $table->foreignId('route_details_stores_id')->constrained('route_details_stores');
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
}
