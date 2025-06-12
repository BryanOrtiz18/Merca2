<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaleController extends Controller
{
public function index()
    {
        // Aquí podrías cargar datos de ventas desde la base de datos si quieres
        // $sales = Sale::all(); // Asegúrate de tener el modelo Sale creado

        return view('sales.index'); // Asegúrate de que esta vista exista
    }
}
