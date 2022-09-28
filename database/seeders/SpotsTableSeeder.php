<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Spot;

class SpotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => '8',
        ];
        Spot::create($param);
        $param = [
            'name' => '9'
        ];
        Spot::create($param);
        $param = [
            'name' => '10'
        ];
        Spot::create($param);
        $param = [
            'name' => '11'
        ];
        Spot::create($param);
        $param = [
            'name' => '12'
        ];
        Spot::create($param);
        $param = [
            'name' => '13'
        ];
        Spot::create($param);
        $param = [
            'name' => '14'
        ];
        Spot::create($param);
        $param = [
            'name' => '16'
        ];
        Spot::create($param);
        $param = [
            'name' => '17'
        ];
        Spot::create($param);
    }
}
