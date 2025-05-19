<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteDetailsStoresTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('route_details', function (Blueprint $table) {
            $table->id();

            $table->date('visit_date')->nullable();
            $table->string('visit_status', 45)->nullable();
            $table->string('description', 45)->nullable();
            $table->string('real_visit_date', 45)->nullable();
            $table->string('longitude', 45)->nullable();
            $table->string('latitude', 45)->nullable();
            $table->foreignId('route_store_id')->constrained('route_store');
            $table->foreignId('employees_id')->constrained('employees');
            $table->string('day_week', 45)->nullable();
            $table->string('week', 45)->nullable();
            $table->string('is_purchase', 45)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('route_details');
    }
}
