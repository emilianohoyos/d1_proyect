<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Neighborhood;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::with('neighborhood')->get();
        return view('store.index', compact('stores'));
    }

    public function create()
    {
        $neighborhoods = Neighborhood::all();
        return view('store.create', compact('neighborhoods'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:45',
            'address' => 'required|string|max:45',
            'name_charge' => 'nullable|string|max:45',
            'phone_1' => 'nullable|string|max:45',
            'phone_2' => 'nullable|string|max:45',
            'email' => 'nullable|email|max:45',
            'status' => 'nullable|string|max:45',
            'descripcion' => 'nullable|string',
            'neighborhood_id' => 'required|exists:neighborhoods,id',
            'priority' => 'nullable|integer',
        ], [], [
            'name' => 'nombre',
            'address' => 'dirección',
            'name_charge' => 'encargado',
            'phone_1' => 'teléfono 1',
            'phone_2' => 'teléfono 2',
            'email' => 'correo',
            'status' => 'estado',
            'descripcion' => 'descripción',
            'neighborhood_id' => 'barrio',
            'priority' => 'prioridad',
        ]);

        // Geocodificación con manejo de errores
        $coordinates = $this->geocodeAddress($validated['address']);

        // Creación del registro con transacción
        try {
            $store = DB::transaction(function () use ($validated, $coordinates) {
                return Store::create(array_merge($validated, [
                    'latitude' => $coordinates['lat'] ?? null,
                    'longitude' => $coordinates['lng'] ?? null,
                    'status' => $validated['status'] ?? true, // Valor por defecto
                ]));
            });

            return redirect()->route('store.index')
                ->with('success', 'Tienda creada correctamente');
        } catch (\Exception $e) {
            Log::error('Error al crear tienda: ' . $e->getMessage());
            return back()->withInput()
                ->with('error', 'Error al crear la tienda. Intente nuevamente.');
        }
    }

    public function edit($id)
    {
        $store = Store::findOrFail($id);
        $neighborhoods = Neighborhood::all();
        return view('store.edit', compact('store', 'neighborhoods'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:45',
            'address' => 'required|string|max:45',
            'name_charge' => 'nullable|string|max:45',
            'phone_1' => 'nullable|string|max:45',
            'phone_2' => 'nullable|string|max:45',
            'email' => 'nullable|email|max:45',
            'status' => 'nullable|string|max:45',
            'descripcion' => 'nullable|string',
            'neighborhood_id' => 'required|exists:neighborhoods,id',
            'priority' => 'nullable|integer',
        ]);

        try {
            $store = Store::findOrFail($id);

            DB::transaction(function () use ($store, $validated) {
                // Actualizar coordenadas solo si la dirección cambió
                if ($store->address !== $validated['address']) {
                    $coordinates = $this->geocodeAddress($validated['address']);
                    $validated['latitude'] = $coordinates['lat'] ?? null;
                    $validated['longitude'] = $coordinates['lng'] ?? null;
                }

                $store->update($validated);
            });

            return redirect()->route('store.index')
                ->with('success', 'Tienda actualizada correctamente');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error("Tienda no encontrada ID: $id - " . $e->getMessage());
            return back()->with('error', 'Tienda no encontrada');
        } catch (\Exception $e) {
            Log::error('Error actualizando tienda ID: ' . $id . ' - ' . $e->getMessage());
            return back()->withInput()
                ->with('error', 'Error al actualizar la tienda. Intente nuevamente.');
        }
    }

    public function destroy($id)
    {
        $store = Store::findOrFail($id);
        $store->delete();
        return redirect()->route('store.index')->with('success', 'Tienda eliminada correctamente');
    }


    protected function geocodeAddress(string $address): array
    {
        try {
            $response = Http::timeout(8)
                ->withHeaders(['User-Agent' => config('app.name')])
                ->get('https://nominatim.openstreetmap.org/search', [
                    'q' => $address . ', Medellín, Colombia', // Añade contexto geográfico
                    'format' => 'json',
                    'limit' => 1,
                    'countrycodes' => 'co',
                    'accept-language' => 'es',
                ]);

            if ($response->successful() && !empty($data = $response->json())) {
                return [
                    'lat' => (float)$data[0]['lat'],
                    'lng' => (float)$data[0]['lon'],
                ];
            }
        } catch (RequestException $e) {
            Log::warning('Geocoding failed: ' . $e->getMessage());
        }

        return ['lat' => null, 'lng' => null];
    }

    public function generateQR(Request $request)
    {
        $qrCode = QrCode::size(300)
            ->backgroundColor(255, 255, 255)
            ->color(0, 0, 0)
            ->generate('Texto o URL a codificar');

        return view('qr.show', compact('qrCode'));
    }

    public function downloadQR($id)
    {
        $store = Store::findOrFail($id);

        return response()->streamDownload(
            function () use ($store) {
                echo QrCode::format('png')
                    ->size(300)
                    ->generate(route('store.show', $store->id));
            },
            "tienda-{$store->id}-qr.png",
            ['Content-Type' => 'image/png']
        );
    }
}
