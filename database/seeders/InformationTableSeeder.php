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
        for($i=0; $i<=4; $i++){
            $param = [
            'airport_admin_id' => 0,
            'title' => "テスト". $i+1,
            'text' => "テストテキストです。"
            ];
            Information::create($param);
        }
        
    }
}
