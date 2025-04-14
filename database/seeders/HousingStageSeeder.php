<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HousingStageSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('housing_stages')->insert([
            ['name' => 'Pendiente'],
            ['name' => 'En Proceso'],
            ['name' => 'Aprobada'],
            ['name' => 'Rechazada'],
            ['name' => 'Entregado'],
        ]);
    }
}
