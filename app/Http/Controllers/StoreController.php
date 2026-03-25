<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Store;
use App\Models\Municipality;
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
        // dd($coordinates = $this->geocodeAddress("Dg. 80 #76-47"));

        $stores = Store::with('neighborhood')
            ->orderByDesc('id')
            ->get();
        return view('store.index', compact('stores'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('store.create', compact('departments'));
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
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
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
            'latitude' => 'latitud',
            'longitude' => 'longitud',
        ]);

        // Convertir puntos a comas en latitud y longitud
        if (isset($validated['latitude']) && $validated['latitude'] !== null) {
            $validated['latitude'] = str_replace('.', ',', $validated['latitude']);
        }
        
        if (isset($validated['longitude']) && $validated['longitude'] !== null) {
            $validated['longitude'] = str_replace('.', ',', $validated['longitude']);
        }
        
        // Creación del registro con transacción
        try {
            $store = DB::transaction(function () use ($validated) {
                return Store::create([
                    'name' => $validated['name'],
                    'address' => $validated['address'],
                    'name_charge' => $validated['name_charge'] ?? null,
                    'phone_1' => $validated['phone_1'] ?? null,
                    'phone_2' => $validated['phone_2'] ?? null,
                    'email' => $validated['email'] ?? null,
                    'status' => $validated['status'] ?? true,
                    'descripcion' => $validated['descripcion'] ?? null,
                    'neighborhood_id' => $validated['neighborhood_id'],
                    'priority' => $validated['priority'] ?? null,
                    'latitude' => $validated['latitude'] ?? null,
                    'longitude' => $validated['longitude'] ?? null,
                ]);
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
        $store = Store::with('neighborhood.municipality.department')->findOrFail($id);
        $departments = Department::all();
        
        // Get the municipality of the store's neighborhood
        $municipalities = [];
        if ($store->neighborhood && $store->neighborhood->municipality) {
            $municipalities = Municipality::where('department_id', $store->neighborhood->municipality->department_id)->get();
        }
        
        // Get the neighborhoods of the municipality
        $neighborhoods = [];
        if ($store->neighborhood && $store->neighborhood->municipality_id) {
            $neighborhoods = Neighborhood::where('municipality_id', $store->neighborhood->municipality_id)->get();
        }
        
        return view('store.edit', compact('store', 'departments', 'municipalities', 'neighborhoods'));
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
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
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
            'latitude' => 'latitud',
            'longitude' => 'longitud',
        ]);

        // Convertir puntos a comas en latitud y longitud
        if (isset($validated['latitude']) && $validated['latitude'] !== null) {
            $validated['latitude'] = str_replace('.', ',', $validated['latitude']);
        }
        
        if (isset($validated['longitude']) && $validated['longitude'] !== null) {
            $validated['longitude'] = str_replace('.', ',', $validated['longitude']);
        }
        
        try {
            $store = Store::findOrFail($id);

            DB::transaction(function () use ($store, $validated) {
                $validated['is_new'] = false;
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


    public function geocodeAddress(string $address): array
    {
        try {
            $apiKey = env('GOOGLE_MAPS_API_KEY');
            $fullAddress = $address . ', Medellín, Colombia';
            $response = Http::timeout(8)
                ->get('https://maps.googleapis.com/maps/api/geocode/json', [
                    'address' => $fullAddress,
                    'key' => $apiKey,
                    'language' => 'es',
                    'region' => 'co',
                ]);
            // var_dump($response->body());
            if ($response->successful() && !empty($data = $response->json()) && $data['status'] === 'OK') {
                $location = $data['results'][0]['geometry']['location'];
                return [
                    'lat' => (float)$location['lat'],
                    'lng' => (float)$location['lng'],
                ];
            } else {
                Log::warning('Google Geocoding failed: ' . ($data['status'] ?? 'Sin respuesta'));
            }
        } catch (\Exception $e) {
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

    public function toggleStatus($id)
    {
        try {
            DB::beginTransaction();

            $store = Store::findOrFail($id);
            $store->status = !$store->status;
            $store->save();

            // Si la tienda se está desactivando, eliminar de todas las rutas
            if (!$store->status) {
                // Obtener los IDs de route_store
                $routeStoreIds = DB::table('route_store')
                    ->where('store_id', $store->id)
                    ->pluck('id')
                    ->toArray();

                if (!empty($routeStoreIds)) {
                    // Eliminar los detalles de ruta primero
                    DB::table('route_details')
                        ->whereIn('route_store_id', $routeStoreIds)
                        ->delete();

                    // Luego eliminar las relaciones de route_store
                    DB::table('route_store')
                        ->where('store_id', $store->id)
                        ->delete();
                }
            }

            DB::commit();

            $message = $store->status ? 'Tienda activada correctamente' : 'Tienda desactivada correctamente';
            session()->flash('success', $message);

            return redirect()->route('store.index');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error al cambiar el estado de la tienda: ' . $e->getMessage());
            return back();
        }
    }
}
