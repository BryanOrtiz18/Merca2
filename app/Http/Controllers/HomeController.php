<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'activeProducts' => Product::where('active', true)->count(),
            'lowStockProducts' => Product::where('stock', '<', 5)->count(),
            'todaySales' => Sale::whereDate('created_at', today())->count(),
            'monthlySales' => Sale::whereMonth('created_at', now()->month)->sum('total')
        ]);
    }
}