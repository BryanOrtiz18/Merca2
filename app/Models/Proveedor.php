<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    // Nombre real de la tabla
    protected $table = 'proveedores';

    protected $fillable = [
       'nombre',
        'nombre_contacto', 
        'email',
        'telefono',
        'direccion',
        'rtn',
        'notas',
        'activo'
        ];


    // Relación con Compras
    public function compras()
    {
        return $this->hasMany(Compra::class, 'proveedor_id');
    }

    // Relación con Cotizaciones
    public function cotizaciones()
    {
        return $this->hasMany(Cotizacion::class, 'proveedor_id');
    }
}
