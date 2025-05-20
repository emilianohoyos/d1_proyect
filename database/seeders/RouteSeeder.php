<?php

namespace Database\Seeders;

use App\Models\Route;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $routes = [
            ['name' => 'BOSQUE + MORAVIA'],
            ['name' => 'IGUANA + SAN GERMAN'],
            ['name' => 'BARRIO ANTIOQUIA'],
            ['name' => 'TRICENTENARIO'],
            ['name' => 'PARIS'],
            ['name' => 'CASTILLA (92BB-80-104)'],
            ['name' => 'ROBLEDO'],
            ['name' => 'GUAYABAL'],
            ['name' => 'BELEN'],
            ['name' => 'VILLA HERMOSA'],
            ['name' => 'PALMAS NIQUITAO'],
            ['name' => 'BUENOS AIRES + CERROS CAMO VALDES + ARANJUEZ'],
            ['name' => 'CORDOBA - CIUDAD CENTRAL'],
            ['name' => 'PICAHTIO MESETA-DIAMANTE'],
            ['name' => 'MADERA-CEVEDO'],
            ['name' => 'BARRIO NUEVO + SANTANDER'],
            ['name' => 'CASTILLA (ALF.LOPEZ) KENNEDY'],
            ['name' => 'MILAGROSA + SALVADOR'],
            ['name' => 'BARRIO PEREZ'],
            ['name' => 'CAMPO VALDES - MANRIQUE'],
            ['name' => 'VILLATINA'],
            ['name' => 'BELALCAZAR']
        ];

        foreach ($routes as $route) {
            Route::updateOrCreate(
                ['name' => $route['name']],
                $route
            );
        }

        $this->command->info('Rutas de Medellín creadas exitosamente! 🚌');
    }
}
