<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sizes')->insert([
            ['name' => 'Pequeño'],
            ['name' => 'Mediano'],
            ['name' => 'Grande'],
            ['name' => 'Muy grande'],
        ]);
    }
}
