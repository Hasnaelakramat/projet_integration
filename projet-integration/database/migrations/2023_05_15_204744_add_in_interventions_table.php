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
        Schema::table('interventions', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('interventions', function (Blueprint $table) {
            $table->dropUnique(['id_intervenant', 'annee_univ', 'semestre', 'id_etab', 'intitule_intervention', 'date_debut', 'date_fin' ]);
            $table->unique(['id_intervenant', 'id_etab', 'intitule_intervention', 'date_debut', 'date_fin' ]); 
        });
    }
};
