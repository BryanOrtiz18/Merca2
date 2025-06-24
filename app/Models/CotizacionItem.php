<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotizacionItem extends Model
{
    use HasFactory;

    protected $table = 'cotizacion_items';

    protected $fillable = [
        'cotizacion_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
        'descripcion_adicional' // Nuevo campo añadido
    ];

    protected $casts = [
        'precio_unitario' => 'decimal:2',
        'subtotal' => 'decimal:2'
    ];

    public function producto()
    {
        return $this->belongsTo(Product::class, 'producto_id');
    }

    public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
    }

    /**
     * Calcula el subtotal automáticamente antes de guardar
     */
    protected static function booted()
    {
        static::saving(function ($item) {
            $item->subtotal = $item->cantidad * $item->precio_unitario;
        });
    }
}