<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgeCategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('agecategories')->insert([
            ['name' => 'Cachorro'],
            ['name' => 'Joven'],
            ['name' => 'Adulto'],
            ['name' => 'Senior'],
        ]);
    }
}
