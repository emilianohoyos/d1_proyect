<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Store;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index()
    {
        $routes = Route::all();
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
        })->get();

        return view('route.stores', compact('route', 'availableStores'));
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
}
