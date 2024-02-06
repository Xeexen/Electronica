<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoria = [
            ['categoria' => 'COMPUTACIÓN'],
            ['categoria' => 'AUDIO Y VIDEO'],
            ['categoria' => 'MICROELECTRÓNICA'],
            ['categoria' => 'CÁMARAS Y DRÓNES'],
            ['categoria' => 'HERRAMIENTAS']
        ];

        Categoria::inster($categoria);
    }
}
