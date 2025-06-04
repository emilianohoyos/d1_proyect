<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\StoreController;
use App\Models\RouteStore;
use App\Models\Store;
use App\Models\RouteDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class StoreApiController extends Controller
{
    protected StoreController $storeController;

    public function __construct(StoreController $storeController)
    {
        $this->storeController = $storeController;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:45',
            'address' => 'required|string|max:45',
            'name_charge' => 'nullable|string|max:45',
            'phone_1' => 'nullable|string|max:45',
            'phone_2' => 'nullable|string|max:45',
            'email' => 'nullable|email|max:45',
            'status' => 'nullable|boolean',
            'descripcion' => 'nullable|string',
            'neighborhood_id' => 'required|exists:neighborhoods,id',
            'priority' => 'nullable|integer',
            'route_id' => 'nullable|exists:routes,id',
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
            'route_id' => 'ruta',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors' => $validator->errors()
            ], 422);
        }
    
        $validated = $validator->validated();
    
        try {
            $route_id = $validated['route_id'];
            unset($validated['route_id']);
            $coordinates = $this->storeController->geocodeAddress($validated['address']);
            
            $store = DB::transaction(function () use ($validated, $coordinates) {
                return Store::create(array_merge($validated, [
                    'latitude' => $coordinates['lat'] ?? null,
                    'longitude' => $coordinates['lng'] ?? null,
                    'status' => $validated['status'] ?? true,
                ]));
            });

            if (!empty($route_id)) {
               $routeStore = RouteStore::create([
                   'route_id' => $route_id,
                   'store_id' => $store->id
               ]);
            }

            // NUEVO: Si la ruta tiene programaciones, agregar la tienda a los mismos días programados
            $routeDetails = RouteDetail::whereHas('routeStore', function ($q) use ($route_id) {
                $q->where('route_id', $route_id);
            })->get();
   
            foreach ($routeDetails as $detail) {
                // Evitar duplicados: solo crear si no existe ya un detalle para este día, tienda y ruta
                $exists = RouteDetail::where('route_store_id', $routeStore->id)
                    ->where('visit_date', $detail->visit_date)
                    ->exists();
                if (!$exists) {
                    RouteDetail::create([
                        'visit_date' => $detail->visit_date,
                        'visit_status' => $detail->visit_status,
                        'description' => $detail->description,
                        'real_visit_date' => $detail->real_visit_date,
                        'longitude' => $detail->longitude,
                        'latitude' => $detail->latitude,
                        'route_store_id' => $routeStore->id,
                        'employees_id' => $detail->employees_id,
                        'day_week' => $detail->day_week,
                        'week' => $detail->week,
                        'is_purchase' => $detail->is_purchase,
                    ]);
                }
            }
            DB::commit();
            return response()->json([
                'success' => true,
                'data' => $store,
                'message' => 'Tienda creada correctamente'
            ], 201);

        } catch (\Exception $e) {
            Log::error('Error al crear tienda: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la tienda',
                'error' => env('APP_DEBUG') ? $e->getMessage() : null
            ], 500);
        }
    }
}
