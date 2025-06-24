<?php

namespace App\Http\Controllers;

use App\Models\Cotizacion;
use App\Models\Proveedor;
use App\Models\Product;
use App\Models\CotizacionItem;
use Illuminate\Http\Request;

class CotizacionController extends Controller
{
    public function index()
    {
        $cotizaciones = Cotizacion::with(['proveedor', 'usuario'])
                                ->orderBy('fecha_cotizacion', 'desc')
                                ->paginate(10);
        
        return view('cotizaciones.index', compact('cotizaciones'));
    }

    public function create()
    {
        $proveedores = Proveedor::where('activo', true)->get();
        $productos = Product::where('activo', true)->get();
        
        return view('cotizaciones.create', compact('proveedores', 'productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'fecha_cotizacion' => 'required|date',
            'fecha_vencimiento' => 'required|date|after:fecha_cotizacion',
            'items' => 'required|array|min:1',
            'items.*.producto_id' => 'required|exists:productos,id',
            'items.*.cantidad' => 'required|integer|min:1',
            'items.*.precio_unitario' => 'required|numeric|min:0',
            'condiciones' => 'nullable|string',
            'moneda' => 'required|in:NIO,USD'
        ]);

        // Calcular total
        $total = collect($request->items)->sum(function($item) {
            return $item['cantidad'] * $item['precio_unitario'];
        });

        // Crear cotización
        $cotizacion = Cotizacion::create([
            'proveedor_id' => $request->proveedor_id,
            'usuario_id' => auth()->id(),
            'fecha_cotizacion' => $request->fecha_cotizacion,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'total' => $total,
            'condiciones' => $request->condiciones,
            'moneda' => $request->moneda,
            'estado' => 'pendiente'
        ]);

        // Guardar items
        foreach ($request->items as $item) {
           CotizacionItem::create([
                'cotizacion_id' => $cotizacion->id,
                'producto_id' => $item['producto_id'],
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio_unitario'],
                'subtotal' => $item['cantidad'] * $item['precio_unitario']
            ]);
        }

        return redirect()->route('cotizaciones.show', $cotizacion)
                        ->with('success', 'Cotización creada exitosamente');
    }

    public function show(Cotizacion $cotizacion)
    {
        $cotizacion->load(['proveedor', 'usuario', 'items.producto']);
        return view('cotizaciones.show', compact('cotizacion'));
    }

    public function aprobar(Cotizacion $cotizacion)
    {
        $cotizacion->update(['estado' => 'aprobado']);
        return back()->with('success', 'Cotización aprobada');
    }

    public function rechazar(Cotizacion $cotizacion)
    {
        $cotizacion->update(['estado' => 'rechazado']);
        return back()->with('success', 'Cotización rechazada');
    }
}