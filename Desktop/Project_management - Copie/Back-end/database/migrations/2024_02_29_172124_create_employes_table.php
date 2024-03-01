<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employes', function (Blueprint $table) {
            $table->bigIncrements('id_employe');
            $table->unsignedBigInteger('id_equipe')->nullable();
            $table->foreign('id_equipe')->references('id_equipe')->on('equipes');
            $table->unsignedBigInteger('id_gestionnaire');
            $table->foreign('id_gestionnaire')->references('id_gestionnaire')->on('gestionnaires');
            $table->boolean('respo')->default(false);
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('mot_de_passe');
            $table->string('tele');
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('employes');
    }
}
