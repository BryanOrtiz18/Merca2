<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventaryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\VentaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí defines las rutas web protegidas y públicas.
|
*/

// Ruta pública (sin auth)
Route::get('/', function () {
    return redirect()->route('ventas.index');
})->name('home');

// Rutas de autenticación (login, registro, etc)
Auth::routes();

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {

    // Panel de control
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // CRUD completo para productos
    Route::resource('products', ProductController::class);

    // Ventas
    Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');

    // Compras
    Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases.index');

    // Traslados
    Route::get('/transfers', [TransferController::class, 'index'])->name('transfers.index');

    // Inventario
    Route::get('/inventary', [InventaryController::class, 'index'])->name('inventary.index');

    // Proveedores
    Route::resource('proveedores', ProveedorController::class);

    // Compras (sin editar, actualizar ni eliminar)
    Route::resource('compras', CompraController::class)->except(['edit', 'update', 'destroy']);

    // Cotizaciones
    Route::resource('cotizaciones', CotizacionController::class);

    // Acciones adicionales de cotizaciones
    Route::post('cotizaciones/{cotizacion}/aprobar', [CotizacionController::class, 'aprobar'])
        ->name('cotizaciones.aprobar');

    Route::post('cotizaciones/{cotizacion}/rechazar', [CotizacionController::class, 'rechazar'])
        ->name('cotizaciones.rechazar');

    // Rutas resource para ventas
    Route::resource('ventas', VentaController::class);

    // Ruta adicional para reporte de ventas
    Route::get('ventas/reporte/mensual', [VentaController::class, 'reporteMensual'])
         ->name('ventas.reporte.mensual');

    // Ruta para exportar a Excel
    Route::get('ventas/exportar/excel', [VentaController::class, 'exportarExcel'])
         ->name('ventas.exportar.excel');
});
