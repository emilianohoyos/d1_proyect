<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with('user', 'documentType')->get();
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $documentTypes = DocumentType::all();
        return view('employee.create', compact('documentTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'identification' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'cellphone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'document_type_id' => 'required|exists:document_types,id',
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|unique:users,email',
            'user_password' => 'required|string|min:6|confirmed',
            'user_type_id' => 'required'
        ], [], [
            'identification' => 'identificación',
            'name' => 'nombre',
            'cellphone' => 'celular',
            'address' => 'dirección',
            'document_type_id' => 'tipo de documento',
            'user_name' => 'usuario',
            'user_email' => 'correo electrónico',
            'user_password' => 'contraseña',
        ]);

        $user = User::create([
            'name' => $request->input('user_name'),
            'email' => $request->input('user_email'),
            'password' => Hash::make($request->input('user_password')),
            'rol' => $request->input('user_type_id')
        ]);

        $employee = Employee::create([
            'identification' => $request->input('identification'),
            'name' => $request->input('name'),
            'cellphone' => $request->input('cellphone'),
            'address' => $request->input('address'),
            'status' => $request->has('status'),
            'document_type_id' => $request->input('document_type_id'),
            'user_id' => $user->id,
        ]);

        return redirect()->route('employee.index')->with('success', 'Empleado y usuario creados correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);
        $documentTypes = DocumentType::all();
        return view('employee.edit', compact('employee', 'documentTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'identification' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'cellphone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'document_type_id' => 'required|exists:document_types,id',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update($request->all());

        return redirect()->route('employee.index')->with('success', 'Empleado actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employee.index')->with('success', 'Empleado eliminado correctamente');
    }
}
