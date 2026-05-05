<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Modelo Eloquent para la tabla 'notes'
class Note extends Model
{
    // Campos que se pueden asignar masivamente (mass assignment)
    protected $fillable = [
        'title',
        'author',
        'body',
        'classification',
    ];
}
