<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CiudadSeeder;
use Database\Seeders\ConsumidorSeeder;
use Database\Seeders\ProvinciasSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call(ProvinciasSeeder::class);
        $this->call(ConsumidorSeeder::class);
    }
}
