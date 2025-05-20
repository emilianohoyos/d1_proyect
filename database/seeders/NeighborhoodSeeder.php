<?php

namespace Database\Seeders;

use App\Models\Neighborhood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NeighborhoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $neighborhoods = [
            // Comunas populares de Medellín
            ['name' => 'El Poblado', 'status' => true],
            ['name' => 'Laureles', 'status' => true],
            ['name' => 'Envigado', 'status' => true],
            ['name' => 'Sabaneta', 'status' => true],
            ['name' => 'Belén', 'status' => true],
            ['name' => 'Robledo', 'status' => true],
            ['name' => 'Bello', 'status' => true],
            ['name' => 'Itagüí', 'status' => true],
            ['name' => 'La América', 'status' => true],
            ['name' => 'La Candelaria', 'status' => true],
            ['name' => 'San Javier', 'status' => true],
            ['name' => 'Aranjuez', 'status' => true],
            ['name' => 'Castilla', 'status' => true],
            ['name' => 'Doce de Octubre', 'status' => true],
            ['name' => 'Villa Hermosa', 'status' => true],
            ['name' => 'Manrique', 'status' => true],
            ['name' => 'Guayabal', 'status' => true],
            ['name' => 'Boston', 'status' => true],
            ['name' => 'La Floresta', 'status' => true],
            ['name' => 'Los Colores', 'status' => true],
        ];

        foreach ($neighborhoods as $neighborhood) {
            Neighborhood::updateOrCreate(
                ['name' => $neighborhood['name']],
                $neighborhood
            );
        }

        $this->command->info('Barrios de Medellín creados exitosamente! 🏙️');
    }
}
