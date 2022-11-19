<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Information;

class InformationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Information::factory()->count(5)->create();
    }
}
