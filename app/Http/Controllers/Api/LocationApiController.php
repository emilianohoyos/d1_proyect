<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LocationHistory;
use App\Models\RouteDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LocationApiController extends Controller
{
    /**
     * Guarda el historial de ubicación del empleado
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'latitude' => 'required|string|max:45',
            'longitude' => 'required|string|max:45',
            'route_details_stores_id' => 'required|exists:route_details_stores,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Datos inválidos',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $location = LocationHistory::create([
                'latitud' => $request->latitude,
                'longitud' => $request->longitude,
                'visit_date' => now(),
                'route_details_stores_id' => $request->route_details_stores_id,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Ubicación guardada correctamente',
                'data' => [
                    'id' => $location->id,
                    'visit_date' => $location->visit_date,
                    'created_at' => $location->created_at,
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al guardar la ubicación',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtiene el historial de ubicación del empleado
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Datos inválidos',
                'errors' => $validator->errors()
            ], 422);
        }

        $locations = LocationHistory::with('routeDetailsStore')
            ->whereHas('routeDetailsStore', function ($query) {
                $query->where('employees_id', Auth::user()->employees_id);
            })
            ->whereBetween('visit_date', [$request->start_date, $request->end_date])
            ->orderBy('visit_date', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $locations->map(function ($location) {
                return [
                    'id' => $location->id,
                    'latitude' => $location->latitud,
                    'longitude' => $location->longitud,
                    'visit_date' => $location->visit_date,
                    'route_details_stores_id' => $location->route_details_stores_id,
                    'created_at' => $location->created_at,
                ];
            })
        ]);
    }
}
