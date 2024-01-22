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
        Schema::create('writeups', function (Blueprint $table) {
            $table->string('id', 8)->unique();
            $table->string('faciliteAcces');
            $table->string('interfaceUtilisateur');
            $table->string('noteQuestion');
            $table->string('noteIndice');
            $table->string('experienceUtilisateur');
            $table->string('isRejouer');
            $table->string('recommandation');
            $table->string('soutienOrganisateur');
            $table->string('exeprienceGlobale');
            $table->string('commentaires')->nullable();
            $table->string('nomFichier');
            $table->string('pathFichier');
            $table->string('user_id');
            $table->string('user_name');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('writeups');
    }
};
