<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{

    public function run(): void
    {
        // Tipos de documento comunes para Latinoamérica/España
        $documentTypes = [
            ['name' => 'Cédula de Ciudadanía'],
            ['name' => 'Tarjeta de Identidad'],
            ['name' => 'Pasaporte'],
            ['name' => 'Cédula de Extranjería'],
            ['name' => 'DNI (Documento Nacional de Identidad)'],
            ['name' => 'RUC (Registro Único de Contribuyentes)'],
        ];

        // Usa updateOrCreate para evitar duplicados
        foreach ($documentTypes as $type) {
            DocumentType::updateOrCreate(
                ['name' => $type['name']], // Buscar por nombre
                $type // Datos a insertar
            );
        }

        // Mensaje de confirmación
        $this->command->info('Tipos de documento creados exitosamente!');
    }
}
