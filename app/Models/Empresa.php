<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresas';

    protected $fillable = [
        'razonSocial',
        'nombreComercial',
        'ciudad',
        'provincia',
        'direccion',
        'ruc',
        'email',
        'telefono',
        'contribuyenteEspecial',
        'numeroContribuyente'
    ];
}
