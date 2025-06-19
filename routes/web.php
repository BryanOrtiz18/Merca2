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
    return view('welcome');
});

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

    // Reportes
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // Inventario
    Route::get('/inventary', [InventaryController::class, 'index'])->name('inventary.index');
});
