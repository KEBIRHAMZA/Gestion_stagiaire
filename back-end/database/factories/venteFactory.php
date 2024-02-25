<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Produit;
use Illuminate\Database\Eloquent\Factories\Factory;

class venteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_produit' => Produit::factory(),
            'id_client' => Client::factory(),
            'date_vente' => $this->faker->date(),
            'quantite' => $this->faker->numberBetween(1, 100),
        ];
    }
}
