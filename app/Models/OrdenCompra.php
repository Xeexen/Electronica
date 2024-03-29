<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenCompra extends Model
{
    use HasFactory;

    protected $table = 'orden_compras';

    protected $fillable = [
        'establecimiento',
        'puntoEmision',
        'secuencial',
        'codigoAcceso',
        'descuento',
        'subtotal',
        'total',
        'proveedor_id'
    ];
}
