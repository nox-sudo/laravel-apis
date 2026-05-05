<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Modelo Eloquent para los personajes
class Character extends Model
{
    protected $fillable = [
        'name',
        'picture',
        'description',
    ];

    // Relación muchos a muchos: un personaje aparece en varias películas
    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }
}
