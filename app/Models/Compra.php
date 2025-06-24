<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $table = 'purchases'; // Mantenemos la tabla original

    protected $fillable = [
        'proveedor_id',
        'usuario_id',
        'fecha_compra',
        'numero_factura',
        'total',
        'estado',
        'notas'
    ];

    // Estados posibles
    const ESTADOS = [
        'pendiente',
        'recibido', 
        'cancelado'
    ];

    // Relación con Proveedor
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'supplier_id');
    }

    // Relación con Usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con Items
    public function items()
    {
        return $this->hasMany(ItemCompra::class, 'purchase_id');
    }
}
