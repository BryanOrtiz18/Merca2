<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;

    protected $table = 'cotizaciones';

    protected $fillable = [
        'proveedor_id',
        'usuario_id',
        'fecha_cotizacion',
        'fecha_vencimiento',
        'total',
        'estado',
        'condiciones', // o 'terminos', asegúrate que coincida con tu base de datos
        'moneda'
    ];

    const ESTADOS = ['pendiente', 'aprobado', 'rechazado'];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function items()
    {
        return $this->hasMany(CotizacionItem::class, 'cotizacion_id');
    }
}
