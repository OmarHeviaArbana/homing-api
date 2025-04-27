<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->truncate();
        DB::table('users')->truncate();
        DB::table('housing_stages')->truncate();
        DB::table('genres')->truncate();
        DB::table('status')->truncate();
        DB::table('sizes')->truncate();
        DB::table('energy_levels')->truncate();
        DB::table('agecategories')->truncate();
        DB::table('species')->truncate();


        $this->call([
            RoleSeeder::class,
            AdminUserSeeder::class,
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
