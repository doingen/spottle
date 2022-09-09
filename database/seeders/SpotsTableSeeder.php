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
            'length' => 17.0,
            'width' => 14.5,
            'accept_jet' => false,
            'max_size_of_helicopter' => 14.5
        ];
        Spot::create($param);
        $param = [
            'name' => '9',
            'length' => 17.0,
            'width' => 18.0,
            'accept_jet' => false,
            'max_size_of_helicopter' => 14.5
        ];
        Spot::create($param);
        $param = [
            'name' => '10',
            'length' => 17.0,
            'width' => 18.0,
            'accept_jet' => false,
            'max_size_of_helicopter' => 14.5
        ];
        Spot::create($param);
        $param = [
            'name' => '11',
            'length' => 17.0,
            'width' => 18.0,
            'accept_jet' => false,
            'max_size_of_helicopter' => 14.5
        ];
        Spot::create($param);
        $param = [
            'name' => '12',
            'length' => 19.0,
            'width' => 18.0,
            'accept_jet' => true,
            'max_size_of_helicopter' => 16.5
        ];
        Spot::create($param);
        $param = [
            'name' => '13',
            'length' => 27.5,
            'width' => 20.0,
            'accept_jet' => true,
            'max_size_of_helicopter' => 17.0
        ];
        Spot::create($param);
        $param = [
            'name' => '14',
            'length' => 27.5,
            'width' => 20.0,
            'accept_jet' => true,
            'max_size_of_helicopter' => 17.0
        ];
        Spot::create($param);
        $param = [
            'name' => '16',
            'length' => 27.5,
            'width' => 20.0,
            'accept_jet' => true,
            'max_size_of_helicopter' => 17.0
        ];
        Spot::create($param);
        $param = [
            'name' => '17',
            'length' => 27.5,
            'width' => 20.0,
            'accept_jet' => true,
            'max_size_of_helicopter' => 17.0
        ];
        Spot::create($param);
    }
}
