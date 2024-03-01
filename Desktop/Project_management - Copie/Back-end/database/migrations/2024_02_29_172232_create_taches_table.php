<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taches', function (Blueprint $table) {
            $table->bigIncrements('id_tache');
            $table->unsignedBigInteger('id_projet');
            $table->foreign('id_projet')->references('id_projet')->on('projets');
            $table->unsignedBigInteger('id_employe')->nullable();
            $table->foreign('id_employe')->references('id_employe')->on('employes');
            $table->string('titre');
            $table->text('description');
            $table->string('etats')->default('en attente');
            $table->boolean('assigne')->default(false);
            $table->date('date_debut');
            $table->date('date_fin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taches');
    }
}
