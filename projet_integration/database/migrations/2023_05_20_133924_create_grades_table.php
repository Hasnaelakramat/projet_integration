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
        Schema::create('grades', function (Blueprint $table) {
            $table->smallIncrements('id_grade');
            $table->string('designation')->unique()->nullable(false);
            $table->unsignedInteger('charge_statutaire')->nullable(false);
            $table->unsignedInteger('taux_horaire_vacation')->nullable(false); // le prix de chaque heure supplémentaire

            // la contrainte check sur le champ "designation", il ne doit contenir qu'à 3 nom: 
            //PES, PA, PH
            
            //$table->raw("check('designation' in('PA', 'PH' , 'PES')");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
