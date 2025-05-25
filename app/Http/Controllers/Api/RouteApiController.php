<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RouteDetail;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RouteApiController extends Controller
{
    /**
     * Obtiene la programación actual del empleado
     */
    public function getCurrentRoute(Request $request)
    {
        $today = Carbon::today();
        $employee = Employee::where('user_id', $request->user()->id)->first();

        // Obtener todas las visitas programadas para hoy
        $scheduledVisits = RouteDetail::with(['routeStore.route', 'routeStore.store'])
            ->where('employees_id', $employee->id)
            ->where('visit_date', $today)
            ->orderBy('created_at')
            ->get();

        if ($scheduledVisits->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'No hay visitas programadas para hoy',
                'data' => null
            ]);
        }

        // Formatear las visitas sin información de distancia
        $formattedVisits = $scheduledVisits->map(function ($visit) {
            return [
                'visit_id' => $visit->id,

                'store' => [
                    'id' => $visit->routeStore->store->id,
                    'name' => $visit->routeStore->store->name,
                    'address' => $visit->routeStore->store->address,
                    'latitude' => $visit->latitude,
                    'longitude' => $visit->longitude,
                    'priority' => $visit->routeStore->store->priority,
                    // Se eliminó el campo distance ya que no tenemos las coordenadas actuales
                ],
                'status' => $visit->visit_status,
                'week' => $visit->week,
                'day_week' => $visit->day_week,
                'scheduled_time' => $visit->created_at->format('H:i:s'),
            ];
        })->values();

        // Ordenar solo por prioridad de tienda (ya que no tenemos distancia)
        $formattedVisits = $formattedVisits->sortBy('store.priority')->values();

        return response()->json([
            'status' => 'success',
            'data' => [
                'route' => [
                    'id' => $scheduledVisits->first()->routeStore->route->id,
                    'name' => $scheduledVisits->first()->routeStore->route->name,
                ],
                'employee' => [
                    'id' => $employee->id,
                    'name' => $employee->name,
                ],
                'date' => $today->format('Y-m-d'),
                'day_name' => $today->locale('es')->dayName,
                'total_visits' => $formattedVisits->count(),
                'completed_visits' => $formattedVisits->where('status', 'completada')->count(),
                'pending_visits' => $formattedVisits->where('status', 'pendiente')->count(),
                'visits' => $formattedVisits,
            ]
        ]);
    }

    /**
     * Lista todas las rutas del empleado
     */
    public function listEmployeeRoutes(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'month' => 'required|date_format:Y-m',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Datos inválidos',
                'errors' => $validator->errors()
            ], 422);
        }

        // Convertir el mes recibido en un rango de fechas
        $startDate = Carbon::createFromFormat('Y-m', $request->month)->startOfMonth();
        $endDate = Carbon::createFromFormat('Y-m', $request->month)->endOfMonth();

        $employee = Employee::where('user_id', $request->user()->id)->first();

        $routes = RouteDetail::with(['routeStore.route', 'routeStore.store'])
            ->where('employees_id', $employee->id)
            ->whereBetween('visit_date', [$startDate, $endDate])
            ->orderBy('visit_date')
            ->orderBy('created_at')
            ->get()
            ->groupBy('visit_date');

        $formattedRoutes = [];
        foreach ($routes as $date => $dayRoutes) {
            $carbonDate = Carbon::parse($date);

            $formattedRoutes[] = [
                'route' => [
                    'id' => $dayRoutes->first()->routeStore->route->id,
                    'name' => $dayRoutes->first()->routeStore->route->name,
                ],
                'date' => $date,
                'day_name' => $carbonDate->locale('es')->dayName,
                'total_visits' => $dayRoutes->count(),
                'completed_visits' => $dayRoutes->where('visit_status', 'completada')->count(),
                'pending_visits' => $dayRoutes->where('visit_status', 'pendiente')->count(),
                'routes' => $dayRoutes->map(function ($route) use ($carbonDate) {  // Pasamos $carbonDate aquí
                    return [
                        'id' => $route->id,
                        'store' => [
                            'id' => $route->routeStore->store->id,
                            'name' => $route->routeStore->store->name,
                            'address' => $route->routeStore->store->address,
                            'latitude' => $route->latitude,
                            'longitude' => $route->longitude,
                        ],
                        'status' => $route->visit_status,
                        'week' => $route->week,
                        'day_week' => $carbonDate->dayOfWeek,
                        'scheduled_time' => $route->created_at->format('H:i:s'),
                        'real_visit_date' => $route->real_visit_date,
                    ];
                })->values()
            ];
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'employee_id' => $request->employee_id,
                'month' => $request->month,
                'total_days_with_routes' => count($formattedRoutes),
                'days' => $formattedRoutes,
            ]
        ]);
    }
    /**
     * Actualiza el estado de una visita
     */
    public function updateVisitStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'visit_id' => 'required|exists:route_details,id',
            'status' => 'required|in:pendiente,completada,cancelada',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'description' => 'nullable|string|max:45',
            'is_purchase' => 'required|in:si,no',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Datos inválidos',
                'errors' => $validator->errors()
            ], 422);
        }

        $visit = RouteDetail::findOrFail($request->visit_id);

        // Verificar que la visita pertenece al empleado actual
        if ($visit->employees_id != $request->employee_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'No tienes permiso para actualizar esta visita'
            ], 403);
        }

        // Actualizar la visita
        $visit->update([
            'visit_status' => $request->status,
            'real_visit_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'description' => $request->description,
            'is_purchase' => $request->is_purchase,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Visita actualizada correctamente',
            'data' => [
                'id' => $visit->id,
                'status' => $visit->visit_status,
                'real_visit_date' => $visit->real_visit_date,
                'description' => $visit->description,
                'is_purchase' => $visit->is_purchase,
            ]
        ]);
    }

    /**
     * Calcula la distancia entre dos puntos usando la fórmula de Haversine
     */
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Radio de la tierra en kilómetros

        $latDelta = deg2rad($lat2 - $lat1);
        $lonDelta = deg2rad($lon2 - $lon1);

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($lonDelta / 2) * sin($lonDelta / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
