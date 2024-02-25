<?php

namespace Database\Factories;

use App\Models\Achat;
use App\Models\Produit;
use App\Models\Fournisseur;
use Illuminate\Database\Eloquent\Factories\Factory;

class AchatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Achat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_produit' => Produit::factory(),
            'id_fournisseur' => Fournisseur::factory(),
            'date_achat' => $this->faker->date(),
            'quantite' => $this->faker->numberBetween(1, 100),
        ];
    }
}
