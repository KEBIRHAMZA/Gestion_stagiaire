<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipes', function (Blueprint $table) {
            $table->bigIncrements('id_equipe');
            $table->unsignedBigInteger('id_projet')->nullable();
            $table->foreign('id_projet')->references('id_projet')->on('projets');
            $table->unsignedBigInteger('id_gestionnaire');
            $table->foreign('id_gestionnaire')->references('id_gestionnaire')->on('gestionnaires');
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
        Schema::dropIfExists('equipes');
    }
}
