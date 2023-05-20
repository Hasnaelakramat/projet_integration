<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('interventions', function (Blueprint $table) {
            $table->bigIncrements('id_intervention');
            $table->string('intitule_intervention')->nullable(false);
            $table->string('annee_univ')->nullable(false);
            $table->char('semestre', 2)->nullable(false);
            $table->date('date_debut')->nullable(false);
            $table->date('date_fin')->nullable(false);
            $table->integer('nbr_heures')->nullable(false);
            $table->boolean('visa_etab')->default(false);
            $table->boolean('visa_uae')->default(false);
            $table->smallInteger('id_etab')->nullable(false);
            $table->bigInteger('id_intervenant')->nullable(false);
            $table->foreign('id_etab')->references('id_etab')->on('etablissements')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_intervenant')->references('id_enseign')->on('enseignants')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interventions');
    }
};
