<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projets', function (Blueprint $table) {
            $table->bigIncrements('id_projet');
            $table->unsignedBigInteger('id_adminitrateur');
            $table->foreign('id_adminitrateur')->references('id_adminitrateur')->on('administrateurs');
            $table->unsignedBigInteger('id_gestionnaire')->nullable();
            $table->foreign('id_gestionnaire')->references('id_gestionnaire')->on('gestionnaires');
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
        Schema::dropIfExists('projets');
    }
}
