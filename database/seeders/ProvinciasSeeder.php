<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProvinciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('provincias')->insert([
            ['codigo' => '01', 'provincia' => 'Azuay'],
            ['codigo' => '02', 'provincia' => 'Bolivar'],
            ['codigo' => '03', 'provincia' => 'Cañar'],
            ['codigo' => '04', 'provincia' => 'Carchi'],
            ['codigo' => '05', 'provincia' => 'Cotopaxi'],
            ['codigo' => '06', 'provincia' => 'Chimborazo'],
            ['codigo' => '07', 'provincia' => 'El Oro'],
            ['codigo' => '08', 'provincia' => 'Esmeraldas'],
            ['codigo' => '09', 'provincia' => 'Guayas'],
            ['codigo' => '10', 'provincia' => 'Imbabura'],
            ['codigo' => '11', 'provincia' => 'Loja'],
            ['codigo' => '12', 'provincia' => 'Los Rios'],
            ['codigo' => '13', 'provincia' => 'Manabi'],
            ['codigo' => '14', 'provincia' => 'Morona Santiago'],
            ['codigo' => '15', 'provincia' => 'Napo'],
            ['codigo' => '16', 'provincia' => 'Pastaza'],
            ['codigo' => '17', 'provincia' => 'Pichincha'],
            ['codigo' => '18', 'provincia' => 'Tungurahua'],
            ['codigo' => '19', 'provincia' => 'Zamora Chinchipe'],
            ['codigo' => '20', 'provincia' => 'Galapagos'],
            ['codigo' => '21', 'provincia' => 'Sucumbios'],
            ['codigo' => '22', 'provincia' => 'Orellana'],
            ['codigo' => '23', 'provincia' => 'Santo Domingo de los Tsachilas'],
            ['codigo' => '24', 'provincia' => 'Santa Elena']
        ]);
    }
}
