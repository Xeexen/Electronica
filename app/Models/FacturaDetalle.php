<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaDetalle extends Model
{
    use HasFactory;

    protected $table = 'factura_detalles';

    protected $fillable = [
        'producto_id',
        'cantidad',
        'descuento',
        'subtotal',
        'factura_id'
    ];
}
