<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCompra extends Model
{
    use HasFactory;

    protected $table = 'purchase_items'; // Mantenemos la tabla original

    protected $fillable = [
        'compra_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'subtotal'
    ];

    // Relación con Compra
    public function compra()
    {
        return $this->belongsTo(Compra::class, 'purchase_id');
    }

    // Relación con Producto
    public function producto()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}