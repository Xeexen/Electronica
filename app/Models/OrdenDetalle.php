<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenDetalle extends Model
{
    use HasFactory;

    protected $table = 'orden_detalles';

    protected $fillable = [
        'producto_id',
        'precio',
        'cantidad',
        'subtotal',
        'orden_id'
    ];
}
