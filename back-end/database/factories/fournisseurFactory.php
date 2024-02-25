<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class fournisseurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->company,
            'adresse' => $this->faker->address,
            'telephone' => $this->faker->phoneNumber,
        ];
    }
}
