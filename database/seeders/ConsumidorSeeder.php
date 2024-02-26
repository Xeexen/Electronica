<?php

namespace Database\Seeders;

use App\Models\Persona;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConsumidorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Persona::insert([
            'nombre' => 'Consumidor Final', 'tipoDocumento' => 'ruc', 'documento' => '9999999999999', 'email' => 'email@example.com', 'provincia' => 'provincia', 'ciudad' => 'ciudad', 'direccion' => 'Direccion Tienda', 'telefono' => '0912345678', 'tipoPersona' => json_encode(['cliente' => true])
        ]);
    }
}
