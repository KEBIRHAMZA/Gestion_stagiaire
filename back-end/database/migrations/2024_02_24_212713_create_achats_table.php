<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achats', function (Blueprint $table) {
            $table->bigIncrements('id_achat');
            $table->unsignedBigInteger('id_produit');
            $table->unsignedBigInteger('id_fournisseur');
            $table->date('date_achat');
            $table->integer('quantite');
            $table->timestamps();
            $table->foreign('id_produit')->references('id_produit')->on('produits');
            $table->foreign('id_fournisseur')->references('id_fournisseur')->on('fournisseurs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('achats');
    }
}
