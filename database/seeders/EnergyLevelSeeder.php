<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnergyLevelSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('energy_levels')->insert([
            ['name' => 'Bajo'],
            ['name' => 'Medio'],
            ['name' => 'Alto'],
        ]);
    }
}

