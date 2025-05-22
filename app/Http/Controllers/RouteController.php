<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Store;
use App\Models\Neighborhood;
use App\Models\RouteDetail;
use App\Models\RouteStore;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RouteController extends Controller
{
    public function index()
    {
        $routes = Route::selectRaw('routes.name as route_name, routes.id as route_id, COUNT(route_store.store_id) as count_store')
            ->leftJoin('route_store', 'routes.id', '=', 'route_store.route_id')
            ->groupBy('routes.id', 'routes.name')
            ->get();

        return view('route.index', compact('routes'));
    }

    public function create()
    {
        return view('route.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:45',
        ], [], [
            'name' => 'nombre',
        ]);

        Route::create([
            'name' => $request->name,
        ]);

        return redirect()->route('route.index')->with('success', 'Ruta creada correctamente');
    }

    public function edit($id)
    {
        $route = Route::findOrFail($id);
        return view('route.edit', compact('route'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:45',
        ], [], [
            'name' => 'nombre',
        ]);

        $route = Route::findOrFail($id);
        $route->update([
            'name' => $request->name,
        ]);

        return redirect()->route('route.index')->with('success', 'Ruta actualizada correctamente');
    }

    public function destroy($id)
    {
        $route = Route::findOrFail($id);
        $route->delete();
        return redirect()->route('route.index')->with('success', 'Ruta eliminada correctamente');
    }

    public function stores($id)
    {
        $route = Route::findOrFail($id);
        $availableStores = Store::whereDoesntHave('routes', function ($query) use ($id) {
            $query->where('routes.id', $id);
        })->with('neighborhood')->get();

        // Obtener solo los barrios que corresponden a las tiendas disponibles
        $neighborhoods = Neighborhood::whereHas('stores', function ($query) use ($availableStores) {
            $query->whereIn('id', $availableStores->pluck('id'));
        })->get();

        return view('route.stores', [
            'route' => $route,
            'availableStores' => $availableStores,
            'neighborhoods' => $neighborhoods
        ]);
    }

    public function addStores(Request $request, $id)
    {
        $request->validate([
            'stores' => 'required|array',
            'stores.*' => 'exists:stores,id'
        ], [], [
            'stores' => 'tiendas',
            'stores.*' => 'tienda'
        ]);

        $route = Route::findOrFail($id);
        $route->stores()->attach($request->stores);

        return redirect()->route('route.stores', $id)
            ->with('success', 'Tiendas agregadas correctamente');
    }

    public function removeStore($routeId, $storeId)
    {
        $route = Route::findOrFail($routeId);
        $route->stores()->detach($storeId);

        return redirect()->route('route.stores', $routeId)
            ->with('success', 'Tienda removida correctamente');
    }

    public function editSchedule($id)
    {
        $schedule = RouteDetail::with('routeStore')->findOrFail($id);
        $routes = Route::all();
        $employees = Employee::all();

        // Obtener las rutas de la semana 1 y 2
        $week1Routes = RouteDetail::where('visit_date', $schedule->visit_date)
            ->where('week', 1)
            ->with('routeStore')
            ->get()
            ->pluck('routeStore.route_id')
            ->toArray();

        $week2Routes = RouteDetail::where('visit_date', $schedule->visit_date)
            ->where('week', 2)
            ->with('routeStore')
            ->get()
            ->pluck('routeStore.route_id')
            ->toArray();

        return view('route.schedule-edit', compact('schedule', 'routes', 'employees', 'week1Routes', 'week2Routes'));
    }

    public function updateSchedule(Request $request, $id)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'week1_routes' => 'required|array|size:6',
            'week2_routes' => 'required|array|size:6',
            'employee_id' => 'required|exists:employees,id',
        ]);

        try {
            DB::beginTransaction();

            // Actualizar la programación existente
            $schedule = RouteDetail::findOrFail($id);
            $schedule->visit_date = $request->start_date;
            $schedule->employees_id = $request->employee_id;
            $schedule->save();

            // Actualizar las rutas de la semana 1
            RouteDetail::where('visit_date', $schedule->visit_date)
                ->where('week', 1)
                ->delete();

            foreach ($request->week1_routes as $index => $routeId) {
                // Obtener o crear el registro route_store
                $routeStore = RouteStore::firstOrCreate([
                    'route_id' => $routeId
                ]);

                RouteDetail::create([
                    'route_store_id' => $routeStore->id,
                    'visit_date' => $request->start_date,
                    'week' => 1,
                    'day' => $index + 1,
                    'employees_id' => $request->employee_id,
                    'visit_status' => 'pendiente',
                    'description' => null,
                    'real_visit_date' => null,
                    'is_purchase' => 'no'
                ]);
            }

            // Actualizar las rutas de la semana 2
            RouteDetail::where('visit_date', $schedule->visit_date)
                ->where('week', 2)
                ->delete();

            foreach ($request->week2_routes as $index => $routeId) {
                // Obtener o crear el registro route_store
                $routeStore = RouteStore::firstOrCreate([
                    'route_id' => $routeId
                ]);

                RouteDetail::create([
                    'route_store_id' => $routeStore->id,
                    'visit_date' => $request->start_date,
                    'week' => 2,
                    'day' => $index + 1,
                    'employees_id' => $request->employee_id,
                    'visit_status' => 'pendiente',
                    'description' => null,
                    'real_visit_date' => null,
                    'is_purchase' => 'no'
                ]);
            }

            DB::commit();
            return redirect()->route('route.index')->with('success', 'Programación actualizada exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al actualizar la programación: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $route = Route::with(['stores', 'routeStores'])->findOrFail($id);
        return view('route.show', compact('route'));
    }

    public function getSchedules(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');

        $schedules = RouteDetail::with(['routeStore.route', 'employee'])
            ->whereBetween('visit_date', [$start, $end])
            ->get()
            ->groupBy(function ($schedule) {
                return $schedule->visit_date . '-' . $schedule->employees_id;
            })
            ->map(function ($group) {
                $first = $group->first();
                return [
                    'id' => $first->id,
                    'employee_id' => $first->employees_id,
                    'employee_name' => $first->employee->name,
                    'visit_date' => $first->visit_date,
                    'week' => $first->week,
                    'routes' => $group->map(function ($item) {
                        return $item->routeStore->route->name;
                    })->unique()->values()->toArray(),
                    'visit_status' => $group->pluck('visit_status')->unique()->implode(', '),
                ];
            })
            ->values();

        return response()->json($schedules);
    }

    public function destroySchedule($id)
    {
        try {
            DB::beginTransaction();

            $schedule = RouteDetail::findOrFail($id);
            $visitDate = $schedule->visit_date;
            $week = $schedule->week;

            // Eliminar todas las programaciones del mismo día y semana
            RouteDetail::where('visit_date', $visitDate)
                ->where('week', $week)
                ->delete();

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
