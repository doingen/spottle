<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AircraftsTableSeeder::class);
        $this->call(SpotsTableSeeder::class);
        $this->call(InformationTableSeeder::class);

    }
}
