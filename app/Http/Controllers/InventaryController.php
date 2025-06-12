<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventaryController extends Controller
{
    public function index()
    {
        return view('Inventary.index'); // Asegúrate de que esta vista exista en resources/views/reports/index.blade.php
    }
}
