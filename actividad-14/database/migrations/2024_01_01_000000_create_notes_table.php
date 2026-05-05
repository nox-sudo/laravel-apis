<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migración para crear la tabla de notas
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id(); // Clave primaria autoincremental
            $table->string('title');       // Título de la nota
            $table->string('author');      // Autor de la nota
            $table->text('body');          // Contenido de la nota
            // Clasificación: solo acepta estos cuatro valores
            $table->enum('classification', ['personal', 'work', 'school', 'other']);
            $table->timestamps();          // created_at y updated_at
        });
    }

    public function down(): void
    {
        // Elimina la tabla si se revierte la migración
        Schema::dropIfExists('notes');
    }
};
