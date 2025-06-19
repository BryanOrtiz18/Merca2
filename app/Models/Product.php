<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

      // Permite asignar masivamente estos campos
    protected $fillable = [
        'name',
        'barcode',
        'purchase_price',
        'sale_price',
        'stock',
        'min_stock',
        'description',
    ];
}
