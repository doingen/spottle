<?php

namespace Database\Factories;

use App\Models\Information;
use Illuminate\Database\Eloquent\Factories\Factory;

class InformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = "テスト". $this->faker->word();

        return [
            'airport_admin_id' => $this->faker->numberBetween(1,10),
            'title' => $title,
            'text' => $this->faker->realText(rand(100,400))
        ];
    }
}
