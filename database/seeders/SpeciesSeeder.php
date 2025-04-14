<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpeciesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('species')->insert([
            ['name' => 'Perro'],
            ['name' => 'Gato'],
            ['name' => 'Conejo'],
            ['name' => 'Ardilla'],
            ['name' => 'Cerdo'],
            ['name' => 'Chinchilla'],
            ['name' => 'Cobaya'],
            ['name' => 'Hamster'],
            ['name' => 'Hurón'],
            ['name' => 'Rata'],
            ['name' => 'Anfibio'],
            ['name' => 'Aracnido'],
            ['name' => 'Ave'],
            ['name' => 'Caballo'],
            ['name' => 'Animal de granja'],
            ['name' => 'Pez'],
            ['name' => 'Reptil'],
            ['name' => 'Otro'],
        ]);
    }
}
