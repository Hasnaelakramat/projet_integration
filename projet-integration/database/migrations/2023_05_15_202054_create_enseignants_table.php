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
            $table->bigIncrements('id');
            $table->string('ppr', 100)->unique()->nullable(false);
            $table->string('nom')->nullable(false);
            $table->string('prenom')->nullable(false);
            $table->date('date_nais');
            // les clés étrangères:

            // pour garantir que la table users va etre créer avant la table enseignant, on utilise AFTER()
           
            $table->smallinteger('etablissement')->nullable(false)->references('id')->on('etablissements')->onDelete('cascade')->onUpdate('cascade');
           
            // Cascade onDelete: si une établissement est supprimée sur la table etablissements, la ligne qui lui associé va etre aussi supprimé
            // Cascade onUpdate:  si id d'une établissement est modifé sur la table etablissements, id de l'étab de la ligne qui lui associé va etre aussi modifé
            
            $table ->smallinteger('id_grade')->nullable(false)->references('id_grade' )->on('grades')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('id_user') -> nullable(false)->references('id_user')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
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
