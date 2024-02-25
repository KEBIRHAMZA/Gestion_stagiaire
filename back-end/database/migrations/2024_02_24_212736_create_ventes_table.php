<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventes', function (Blueprint $table) {
            $table->id('id_vente');
            $table->unsignedBigInteger('id_produit');
            $table->unsignedBigInteger('id_client');
            $table->date('date_vente');
            $table->integer('quantite');
            $table->timestamps();
            $table->foreign('id_produit')->references('id_produit')->on('produits');
            $table->foreign('id_client')->references('id_client')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventes');
    }
}
