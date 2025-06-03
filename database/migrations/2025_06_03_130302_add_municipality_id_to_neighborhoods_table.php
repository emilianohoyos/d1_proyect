<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('neighborhoods', function (Blueprint $table) {
            $table->unsignedInteger('municipality_id')->nullable()->after('status');
            $table->foreign('municipality_id')
                ->references('id')
                ->on('municipalities')
                ->onDelete('set null');
        });

        //medellin
        DB::table('neighborhoods')->insert([
            ['name' => 'El Poblado', 'status' => true, 'municipality_id' => 547],
            ['name' => 'Laureles', 'status' => true, 'municipality_id' => 547],
            ['name' => 'Belén', 'status' => true, 'municipality_id' => 547],
            ['name' => 'Buenos Aires', 'status' => true, 'municipality_id' => 547],
            ['name' => 'Aranjuez', 'status' => true, 'municipality_id' => 547],
            ['name' => 'Castilla', 'status' => true, 'municipality_id' => 547],
            ['name' => 'Robledo', 'status' => true, 'municipality_id' => 547],
            ['name' => 'San Javier', 'status' => true, 'municipality_id' => 547],
            ['name' => 'Guayabal', 'status' => true, 'municipality_id' => 547],
            ['name' => 'Manrique', 'status' => true, 'municipality_id' => 547],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('neighborhoods', function (Blueprint $table) {
            $table->dropForeign(['municipality_id']);
            $table->dropColumn('municipality_id');
        });
    }
};
