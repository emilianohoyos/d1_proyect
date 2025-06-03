<?php

namespace App\Http\Controllers;

use App\Models\Neighborhood;
use App\Models\Municipality;
use App\Models\Department;
use Illuminate\Http\Request;

class NeighborhoodController extends Controller
{
    public function index()
    {
        $neighborhoods = Neighborhood::with(['municipality'])->get();
        return view('neighborhood.index', compact('neighborhoods'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('neighborhood.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:45',
            'municipality_id' => 'required|exists:municipalities,id',
            'status' => 'required|boolean'
        ]);

        Neighborhood::create($request->all());
        
        return redirect()->route('neighborhood.index')
            ->with('success', 'Barrio creado exitosamente');
    }

    public function edit(Neighborhood $neighborhood)
    {
        $departments = Department::all();
        $neighborhood->load('municipality');
        return view('neighborhood.edit', compact('neighborhood', 'departments'));
    }

    public function update(Request $request, Neighborhood $neighborhood)
    {
        $request->validate([
            'name' => 'required|string|max:45',
            'municipality_id' => 'required|exists:municipalities,id',
            'status' => 'required|boolean'
        ]);

        $neighborhood->update($request->all());
        
        return redirect()->route('neighborhood.index')
            ->with('success', 'Barrio actualizado exitosamente');
    }

    public function destroy(Neighborhood $neighborhood)
    {
        $neighborhood->delete();
        return redirect()->route('neighborhood.index')
            ->with('success', 'Barrio eliminado exitosamente');
    }
}
