<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::orderBy('nombre')->paginate(10);
        return view('proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('proveedores.create');
    }

   public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'nombre_contacto' => 'required|string|max:255', // Campo requerido
            'email' => 'required|email|unique:proveedores',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string',
            'rtn' => 'nullable|string|max:14',
            'notas' => 'nullable|string',
            'activo' => 'sometimes|boolean'
        ]);

        Proveedor::create($validated);

        return redirect()->route('proveedores.index')
                         ->with('success', 'Proveedor creado exitosamente');
    }

    public function show(Proveedor $proveedor)
    {
        return view('proveedores.show', compact('proveedor'));
    }

    public function edit(Proveedor $proveedor)
    {
        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, Proveedor $proveedor)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'nombre_contacto' => 'required|string|max:255',
            'email' => 'required|email|unique:proveedores,email,'.$proveedor->id,
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string',
            'rtn' => 'nullable|string|max:14|regex:/^[0-9-]+$/',
            'observaciones' => 'nullable|string',
            'activo' => 'required|boolean'
        ]);

        $proveedor->update($validated);

        return redirect()->route('proveedores.index')
                         ->with('exito', 'Proveedor actualizado correctamente');
    }

    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();
        return redirect()->route('proveedores.index')
                         ->with('success', 'Proveedor eliminado correctamente');
    }
}