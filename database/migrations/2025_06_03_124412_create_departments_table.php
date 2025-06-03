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
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id('department_id');
            $table->string('department_name');
            $table->timestamps();
        });

        // Insert departments data
        DB::table('departments')->insert([
            ['department_id' => 5, 'department_name' => 'ANTIOQUIA'],
            ['department_id' => 8, 'department_name' => 'ATLÁNTICO'],
            ['department_id' => 11, 'department_name' => 'BOGOTÁ, D.C.'],
            ['department_id' => 13, 'department_name' => 'BOLÍVAR'],
            ['department_id' => 15, 'department_name' => 'BOYACÁ'],
            ['department_id' => 17, 'department_name' => 'CALDAS'],
            ['department_id' => 18, 'department_name' => 'CAQUETÁ'],
            ['department_id' => 19, 'department_name' => 'CAUCA'],
            ['department_id' => 20, 'department_name' => 'CESAR'],
            ['department_id' => 23, 'department_name' => 'CÓRDOBA'],
            ['department_id' => 25, 'department_name' => 'CUNDINAMARCA'],
            ['department_id' => 27, 'department_name' => 'CHOCÓ'],
            ['department_id' => 41, 'department_name' => 'HUILA'],
            ['department_id' => 44, 'department_name' => 'LA GUAJIRA'],
            ['department_id' => 47, 'department_name' => 'MAGDALENA'],
            ['department_id' => 50, 'department_name' => 'META'],
            ['department_id' => 52, 'department_name' => 'NARIÑO'],
            ['department_id' => 54, 'department_name' => 'NORTE DE SANTANDER'],
            ['department_id' => 63, 'department_name' => 'QUINDIO'],
            ['department_id' => 66, 'department_name' => 'RISARALDA'],
            ['department_id' => 68, 'department_name' => 'SANTANDER'],
            ['department_id' => 70, 'department_name' => 'SUCRE'],
            ['department_id' => 73, 'department_name' => 'TOLIMA'],
            ['department_id' => 76, 'department_name' => 'VALLE DEL CAUCA'],
            ['department_id' => 81, 'department_name' => 'ARAUCA'],
            ['department_id' => 85, 'department_name' => 'CASANARE'],
            ['department_id' => 86, 'department_name' => 'PUTUMAYO'],
            ['department_id' => 88, 'department_name' => 'ARCHIPIÉLAGO DE SAN ANDRÉS, PROVIDENCIA Y SANTA CATALINA'],
            ['department_id' => 91, 'department_name' => 'AMAZONAS'],
            ['department_id' => 94, 'department_name' => 'GUAINÍA'],
            ['department_id' => 95, 'department_name' => 'GUAVIARE'],
            ['department_id' => 97, 'department_name' => 'VAUPÉS'],
            ['department_id' => 99, 'department_name' => 'VICHADA']
        ]);
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
