<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class produitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'libelle' => $this->faker->word,
            'prix' => $this->faker->randomFloat(2, 1, 1000),
            'quantite' => $this->faker->numberBetween(1, 100),
        ];
    }
}
