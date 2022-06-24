<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TipocuentaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombres' => $this->faker->name(),
            'interes' => $this->faker->unique()->numberBetween(1, 99),

        ];
            
    }
}
