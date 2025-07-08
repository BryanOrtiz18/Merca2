<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VentaController extends Controller
{
    public function index()
    {
        // Paginamos 10 ventas por página ordenadas por fecha descendente
        $ventas = Venta::orderBy('fecha', 'desc')->paginate(10);

        // Total de ventas del día actual
        $totalHoy = Venta::whereDate('fecha', Carbon::today())->sum('total');

        return view('ventas.index', compact('ventas', 'totalHoy'));
    }

    public function create()
    {
        $fechaActual = Carbon::now()->format('Y-m-d');
        return view('ventas.create', compact('fechaActual'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente' => 'required|string|max:100',
            'ruc' => 'nullable|string|size:14',
            'total' => 'required|numeric|min:0',
            'productos' => 'required|string',
            'fecha' => 'required|date',
            'tipo_pago' => 'required|in:Contado,Crédito',
            'vendedor' => 'required|string|max:50'
        ]);

        Venta::create($request->all());

        return redirect()->route('ventas.index')
                         ->with('success', 'Venta registrada exitosamente.');
    }

    public function edit($id)
    {
        $venta = Venta::findOrFail($id);
        return view('ventas.edit', compact('venta'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cliente' => 'required|string|max:100',
            'ruc' => 'nullable|string|size:14',
            'total' => 'required|numeric|min:0',
            'productos' => 'required|string',
            'fecha' => 'required|date',
            'tipo_pago' => 'required|in:Contado,Crédito',
            'vendedor' => 'required|string|max:50'
        ]);

        $venta = Venta::findOrFail($id);
        $venta->update($request->all());

        return redirect()->route('ventas.index')
                         ->with('success', 'Venta actualizada correctamente.');
    }

    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);
        $venta->delete();

        return redirect()->route('ventas.index')
                         ->with('success', 'Venta eliminada correctamente.');
    }

    public function show($id)
{
    $venta = Venta::findOrFail($id);
    return view('ventas.show', compact('venta'));
}
}
