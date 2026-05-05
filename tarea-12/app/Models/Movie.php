<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Modelo Eloquent para las películas / series
class Movie extends Model
{
    protected $fillable = [
        'name',
        'classification',
        'release_date',
        'review',
        'season',
    ];

    // Relación muchos a muchos: una película tiene varios personajes
    public function characters()
    {
        return $this->belongsToMany(Character::class);
    }
}
