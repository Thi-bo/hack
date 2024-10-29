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
        Schema::create('questions', function (Blueprint $table) {
            $table->string('id', 8)->unique();
            $table->string('points');
            $table->string('titre');
            $table->text('description');
            $table->string('level');
            $table->string('hint')->nullable();
            $table->string('hint_point')->default = 'None';
            $table->string('file')->nullable();
            $table->string('path')->nullable();
            $table->string('category');
            $table->integer('solved_by')->nullable();
            $table->string('flag')->default = 'hack_CTF{}';
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
