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
            'airport_admin_id' => 0,
            'name' => '8',
        ];
        Spot::create($param);
        $param = [
            'airport_admin_id' => 0,
            'name' => '9'
        ];
        Spot::create($param);
        $param = [
            'airport_admin_id' => 0,
            'name' => '10'
        ];
        Spot::create($param);
        $param = [
            'airport_admin_id' => 0,
            'name' => '11'
        ];
        Spot::create($param);
        $param = [
            'airport_admin_id' => 0,
            'name' => '12'
        ];
        Spot::create($param);
        $param = [
            'airport_admin_id' => 0,
            'name' => '13'
        ];
        Spot::create($param);
        $param = [
            'airport_admin_id' => 0,
            'name' => '14'
        ];
        Spot::create($param);
        $param = [
            'airport_admin_id' => 0,
            'name' => '16'
        ];
        Spot::create($param);
        $param = [
            'airport_admin_id' => 0,
            'name' => '17'
        ];
        Spot::create($param);
    }
}
