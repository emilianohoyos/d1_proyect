<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Employee;
use App\Models\RouteDetail;
use App\Models\RouteStore;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RouteScheduleController extends Controller
{
    public function create()
    {
        $routes = Route::all();
        $employees = Employee::all();
        return view('route.schedule', compact('routes', 'employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'week1_routes' => 'required|array|size:6',
            'week1_routes.*' => 'exists:routes,id',
            'week2_routes' => 'required|array|size:6',
            'week2_routes.*' => 'exists:routes,id',
            'employee_id' => 'required|exists:employees,id',
        ], [], [
            'start_date' => 'fecha inicial',
            'end_date' => 'fecha final',
            'week1_routes' => 'rutas semana 1',
            'week1_routes.*' => 'ruta semana 1',
            'week2_routes' => 'rutas semana 2',
            'week2_routes.*' => 'ruta semana 2',
            'employee_id' => 'empleado',
        ]);

        try {
            DB::beginTransaction();

            $startDate = Carbon::parse($request->start_date);
            $endDate = Carbon::parse($request->end_date);
            $currentDate = $startDate->copy();
            $weekNumber = 1;

            while ($currentDate <= $endDate) {
                // Skip Sundays
                if ($currentDate->dayOfWeek === Carbon::SUNDAY) {
                    $currentDate->addDay();
                    continue;
                }

                // Get the route for the current day based on week number
                $routeId = $weekNumber === 1
                    ? $request->week1_routes[$currentDate->dayOfWeek - 1]
                    : $request->week2_routes[$currentDate->dayOfWeek - 1];

                $route = Route::with(['stores' => function ($query) {
                    $query->orderBy('priority', 'asc');
                }])->findOrFail($routeId);

                // Create route details for each store in the route
                foreach ($route->stores as $store) {
                    // Get or create the route_store record
                    $routeStore = RouteStore::firstOrCreate(
                        [
                            'route_id' => $routeId,
                            'store_id' => $store->id
                        ]
                    );

                    RouteDetail::create([
                        'visit_date' => $currentDate->format('Y-m-d'),
                        'visit_status' => 'pendiente',
                        'description' => null,
                        'real_visit_date' => null,
                        'longitude' => $store->longitude,
                        'latitude' => $store->latitude,
                        'route_store_id' => $routeStore->id,
                        'employees_id' => $request->employee_id,
                        'day_week' => $currentDate->locale('es')->dayName,
                        'week' => $weekNumber,
                        'is_purchase' => 'no',
                    ]);
                }

                // Switch weeks after Saturday
                if ($currentDate->dayOfWeek === Carbon::SATURDAY) {
                    $weekNumber = $weekNumber === 1 ? 2 : 1;
                }

                $currentDate->addDay();
            }

            DB::commit();
            return redirect()->route('route.index')
                ->with('success', 'Programación de rutas creada correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Error al crear la programación: ' . $e->getMessage());
        }
    }

    public function search()
    {
        $employees = Employee::all();
        return view('route.schedule-search', compact('employees'));
    }

    public function results(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required|date_format:Y-m',
        ], [], [
            'employee_id' => 'empleado',
            'month' => 'mes',
        ]);

        $startDate = Carbon::parse($request->month)->startOfMonth();
        $endDate = Carbon::parse($request->month)->endOfMonth();

        $schedules = RouteDetail::with(['routeStore.route', 'routeStore.store', 'employee'])
            ->where('employees_id', $request->employee_id)
            ->whereBetween('visit_date', [$startDate, $endDate])
            ->orderBy('visit_date')
            ->orderBy('week')
            ->get()
            ->groupBy(function ($schedule) {
                return Carbon::parse($schedule->visit_date)->format('Y-m-d');
            });

        $employee = Employee::findOrFail($request->employee_id);
        $monthName = Carbon::parse($request->month)->locale('es')->isoFormat('MMMM YYYY');

        return view('route.schedule-results', compact('schedules', 'employee', 'monthName'));
    }
}
