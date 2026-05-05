<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migración para la tabla de películas / series
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('name');         // Título de la película o serie
            // Género: solo acepta estos cuatro valores
            $table->enum('classification', ['drama', 'action', 'suspense', 'other']);
            $table->date('release_date');   // Fecha de estreno
            $table->text('review');         // Reseña o descripción
            // Temporada: solo aplica para series (nullable)
            $table->unsignedSmallInteger('season')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
