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
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Agrupación con middleware 'auth'
Route::middleware(['auth'])->group(function () {
    // Panel de control
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Productos
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    // Ventas
    Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');

    // Compras
    Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases.index');

    // Traslados
    Route::get('/transfers', [TransferController::class, 'index'])->name('transfers.index');

    // Reportes
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});
    // Inventary
    Route::get('/inventary', [InventaryController::class, 'index'])->name('Inventary.index');
