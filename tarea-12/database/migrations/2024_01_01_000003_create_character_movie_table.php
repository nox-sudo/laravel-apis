<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Tabla pivote para la relación muchos a muchos entre personajes y películas
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('character_movie', function (Blueprint $table) {
            $table->id();
            // Llave foránea hacia characters — se elimina en cascada
            $table->foreignId('character_id')
                  ->constrained()
                  ->cascadeOnDelete();
            // Llave foránea hacia movies — se elimina en cascada
            $table->foreignId('movie_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('character_movie');
    }
};
