<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    use HasFactory;

    protected $table = 'ordenes';

    protected $fillable = [
        'numero',
        'cliente_id',
        'cancelado',
        'enviado',
        'recibido',
        'total',
        'formaPago'
    ];

    public function getDataAttribute($value)
    {
        return json_decode($value);
    }
}
