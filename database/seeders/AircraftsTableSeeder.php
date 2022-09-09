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
            'name' => 'セスナ525C',
            'length' => 16.26,
            'width' => 15.49,
            'jet' => true,
            'helicopter' => false
        ];
        Aircraft::create($param);
        $param = [
            'airport_admin_id' => 0,
            'name' => 'セスナ680',
            'length' => 19.37,
            'width' => 19.24,
            'jet' => true,
            'helicopter' => false
        ];
        Aircraft::create($param);
        $param = [
            'airport_admin_id' => 0,
            'name' => 'パイパーPA-28-181',
            'length' => 7.25,
            'width' => 10.67,
            'jet' => false,
            'helicopter' => false
        ];
        Aircraft::create($param);
        $param = [
            'airport_admin_id' => 0,
            'name' => 'セスナ172N',
            'length' => 8.20,
            'width' => 10.92,
            'jet' => false,
            'helicopter' => false
        ];
        Aircraft::create($param);
        $param = [
            'airport_admin_id' => 0,
            'name' => 'ベル206B',
            'length' => 11.82,
            'width' => 10.16,
            'jet' => false,
            'helicopter' => true
        ];
        Aircraft::create($param);
        $param = [
            'airport_admin_id' => 0,
            'name' => 'エアバスヘリコプターズAS332',
            'length' => 18.70,
            'width' => 15.60,
            'jet' => false,
            'helicopter' => true
        ];
        Aircraft::create($param);
    }
}
