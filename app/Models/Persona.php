<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'personas';

    protected $fillable =[ 
        'nombre',
        'tipoDocumento',
        'documento',
        'email',
        'provincia',
        'ciudad',
        'direccion',
        'telefono',
        'tipoPersona'
    ];

    public function getDataAttribute($value)
    {
        return json_decode($value);
    }
}
