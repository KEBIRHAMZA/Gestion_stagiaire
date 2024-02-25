<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class clientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->name,
            'adresse' => $this->faker->address,
            'telephone' => $this->faker->phoneNumber,
        ];
    }
}
