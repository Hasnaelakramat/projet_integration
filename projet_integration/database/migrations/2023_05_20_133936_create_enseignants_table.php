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
        Schema::create('enseignants', function (Blueprint $table) {
            $table->bigIncrements('id_enseign');
            $table->string('ppr', 100)->unique()->nullable(false);
            $table->string('nom')->nullable(false);
            $table->string('prenom')->nullable(false);
            $table->date('date_nais');
            // Foreign key references
            $table->smallInteger('id_etab')->nullable(false);
            $table->smallInteger('id_grade')->nullable(false);
            $table->bigInteger('id_user')->nullable(false);
            
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_etab')->references('id_etab')->on('etablissements')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_grade')->references('id_grade')->on('grades')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enseignants');
    }
};
