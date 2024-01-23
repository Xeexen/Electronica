<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

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
