<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuxTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('housing_stages')->truncate();
        DB::table('genres')->truncate();
        DB::table('status')->truncate();
        DB::table('sizes')->truncate();
        DB::table('energy_levels')->truncate();
        DB::table('agecategories')->truncate();
        DB::table('species')->truncate();

        $this->call([
            HousingStageSeeder::class,
            GenreSeeder::class,
            StatusSeeder::class,
            SizeSeeder::class,
            EnergyLevelSeeder::class,
            AgeCategorySeeder::class,
            SpeciesSeeder::class,
        ]);
    }
}
