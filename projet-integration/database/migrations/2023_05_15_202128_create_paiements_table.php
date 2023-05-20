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
        Schema::create('paiements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_intervenant')->nullable(false)->references('id')->on('enseignants')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedSmallInteger('id_etab')->nullable(false)->references('id')->on('etablissements')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('vh')->nullable(false);
            $table->integer('taux_H')->nullable(false);
            $table->float('brut')->nullable(false);
            $table->float('ir')->nullable(false);
            $table->float('net')->nullable(false);
            $table->string('annee_univ')->nullable(false);
            $table->char('semestre',2)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
