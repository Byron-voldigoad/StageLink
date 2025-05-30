<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffresStageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offres_stage', function (Blueprint $table) {
            $table->bigIncrements('id_offre_stage');
            $table->unsignedBigInteger('id_entreprise');
            $table->string('titre', 255);
            $table->text('description');
            $table->text('exigences')->nullable();
            $table->string('duree', 100)->nullable();
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->string('localisation', 255)->nullable();
            $table->decimal('remuneration', 10, 2)->nullable();
            $table->string('secteur', 255)->nullable();
            $table->enum('statut', ['ouvert', 'ferme', 'en_attente'])->default('en_attente');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->foreign('id_entreprise')->references('id_entreprise')->on('entreprises')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offres_stage');
    }
}
