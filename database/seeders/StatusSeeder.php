<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('status')->insert([
            ['name' => 'Disponible'],
            ['name' => 'En adopción'],
            ['name' => 'En tránsito'],
            ['name' => 'Urgente'],
        ]);
    }
}
