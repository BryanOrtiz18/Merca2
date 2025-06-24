<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Proveedor;
use App\Models\Product;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function index()
    {
        $compras = Compra::with(['proveedor', 'usuario'])->latest()->paginate(10);
        return view('compras.index', compact('compras'));
    }

    public function create()
    {
        $proveedores = Proveedor::where('activo', true)->get();
        $producto = Product::where('activo', true)->get();
        return view('compras.create', compact('proveedores', 'productos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'fecha_compra' => 'required|date',
            'numero_factura' => 'required|string|unique:compras',
            'items' => 'required|array|min:1',
            'items.*.producto_id' => 'required|exists:productos,id',
            'items.*.cantidad' => 'required|integer|min:1',
            'items.*.precio_unitario' => 'required|numeric|min:0',
            'observaciones' => 'nullable|string'
        ]);

        // Calcular total
        $total = collect($validated['items'])->sum(function($item) {
            return $item['cantidad'] * $item['precio_unitario'];
        });

        // Crear compra
        $compra = Compra::create([
            'proveedor_id' => $validated['proveedor_id'],
            'usuario_id' => auth()->id(),
            'fecha_compra' => $validated['fecha_compra'],
            'numero_factura' => $validated['numero_factura'],
            'total' => $total,
            'observaciones' => $validated['observaciones'] ?? null
        ]);

        // Agregar items
        foreach ($validated['items'] as $item) {
            $compra->items()->create([
                'producto_id' => $item['producto_id'],
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio_unitario'],
                'subtotal' => $item['cantidad'] * $item['precio_unitario']
            ]);

            // Actualizar stock del producto
            Product::where('id', $item['producto_id'])->increment('existencia', $item['cantidad']);
        }

        return redirect()->route('compras.index')
                         ->with('exito', 'Compra registrada exitosamente');
    }

    public function show(Compra $compra)
    {
        return view('compras.show', compact('compra'));
    }
}