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
        Schema::create('administrateurs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ppr', 100)->nullable(false)->unique();
            $table->string('nom')->nullable(false);
            $table->string('prenom')->nullable(false);
        
            // Les clés étrangères
            $table->unsignedSmallInteger('etablissement')->nullable(false);
            $table->foreign('etablissement')->references('id')->on('etablissements')->onDelete('cascade')->onUpdate('cascade');
        
            $table->unsignedInteger('id_user')->nullable(false);
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrateurs');
    }
};
