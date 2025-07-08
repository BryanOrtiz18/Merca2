<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente',
        'ruc',
        'total',
        'productos',
        'fecha',
        'tipo_pago',
        'vendedor',
    ];

    protected $casts = [
        'fecha' => 'date',  // <- esto permite usar ->format() en la vista
    ];

    public function getTotalFormateadoAttribute()
    {
        return 'C$ ' . number_format($this->total, 2, '.', ',');
    }
}
