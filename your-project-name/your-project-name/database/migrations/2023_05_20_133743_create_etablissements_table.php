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
        Schema::create('etablissements', function (Blueprint $table) {
            $table->smallIncrements('id_etab');
            $table->string('code', 255)->nullable(false)->unique();
            $table->string('nom', 100)->nullable(false);
            $table->string('telephone', 50)->nullable(false);
            $table->string('faxe', 50);
            $table->string('ville')->nullable(false);
            $table->unsignedinteger('nbr_enseignants')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etablissements');
    }
};
