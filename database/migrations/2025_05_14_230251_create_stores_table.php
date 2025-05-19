<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45)->nullable();
            $table->string('address', 45)->nullable();
            $table->string('name_charge', 45)->nullable();
            $table->string('phone_1', 45)->nullable();
            $table->string('phone_2', 45)->nullable();
            $table->string('email', 45)->nullable();
            $table->string('latitude', 45)->nullable();
            $table->string('longitude', 45)->nullable();
            $table->string('status', 45)->nullable();
            $table->text('descripcion')->nullable();
            $table->foreignId('neighborhood_id')->constrained('neighborhoods');
            $table->integer('priority')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
}
