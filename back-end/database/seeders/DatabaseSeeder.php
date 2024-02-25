<?php

namespace Database\Seeders;

use App\Models\Achat;
use App\Models\Vente;
use App\Models\Client;
use App\Models\Produit;
use App\Models\Fournisseur;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create()

        Achat::factory(20)->create();
        Vente::factory(20)->create();
    }
}
