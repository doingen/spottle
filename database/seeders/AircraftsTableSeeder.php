<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Aircraft;

class AircraftsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'airport_admin_id' => 0,
            'name' => 'セスナ525C'
        ];
        Aircraft::create($param)->spots()->attach([5, 6, 7, 8, 9]);
        $param = [
            'airport_admin_id' => 0,
            'name' => 'セスナ680'
        ];
        Aircraft::create($param)->spots()->attach([5, 6, 7, 8, 9]);
        $param = [
            'airport_admin_id' => 0,
            'name' => 'パイパーPA-28-181'
        ];
        Aircraft::create($param)->spots()->attach([1, 2, 3, 4, 5, 6, 7, 8, 9]);
        $param = [
            'airport_admin_id' => 0,
            'name' => 'セスナ172N'
        ];
        Aircraft::create($param)->spots()->attach([1, 2, 3, 4, 5, 6, 7, 8, 9]);
        $param = [
            'airport_admin_id' => 0,
            'name' => 'ベル206B'
        ];
        Aircraft::create($param)->spots()->attach([1, 2, 3, 4, 5, 6, 7, 8, 9]);
        $param = [
            'airport_admin_id' => 0,
            'name' => 'エアバスヘリコプターズAS332'
        ];
        Aircraft::create($param)->spots()->attach([6, 7, 8, 9]);
    }
}
