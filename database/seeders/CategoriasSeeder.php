<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Subcategoria;
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
            ['categoria' => 'SEGURIDAD'],
            ['categoria' => 'FOTOGRAFIA'],
            ['categoria' => 'CELULARES Y TABLETS']
        ];

        Categoria::inster($categoria);

        $subcategoria = [
            ["subcategoria" => "Perifericos","categoria_id" => 1],
            ["subcategoria" => "Almacenamiento","categoria_id" => 1],
            ["subcategoria" => "Redes","categoria_id" => 1],
            ["subcategoria" => "Cargadores y Baterias","categoria_id" => 1],
            ["subcategoria" => "Limpieza","categoria_id" => 1],
            ["subcategoria" => "Cables","categoria_id" => 2],
            ["subcategoria" => "Microfonos","categoria_id" => 2],
            ["subcategoria" => "Convertidores","categoria_id" => 2],
            ["subcategoria" => "Accesorios","categoria_id" => 2],
            ["subcategoria" => "Microfonos","categoria_id" => 2],
            ["subcategoria" => "Telefonos","categoria_id" => 3],
            ["subcategoria" => "Sirenas","categoria_id" => 3],
            ["subcategoria" => "Alarmas","categoria_id" => 3],
            ["subcategoria" => "Cerco Eléctrico inteligente","categoria_id" => 3],
            ["subcategoria" => "Equipos de control de acceso","categoria_id" => 3],
            ["subcategoria" => "Cannon","categoria_id" => 4],
            ["subcategoria" => "Nikon","categoria_id" => 4],
            ["subcategoria" => "Sony","categoria_id" => 4],
            ["subcategoria" => "Panasonic","categoria_id" => 4],
            ["subcategoria" => "Fujifilm","categoria_id" => 4],
            ["subcategoria" => "Iphone","categoria_id" => 5],
            ["subcategoria" => "Samsung","categoria_id" => 5],
            ["subcategoria" => "Huawei","categoria_id" => 5],
            ["subcategoria" => "Xiaomi","categoria_id" => 5],
            ["subcategoria" => "Honor","categoria_id" => 5],








        ];

        Subcategoria::inster($subcategoria);
    }
}
