<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Character;
use App\Models\Movie;

// Seeder de ejemplo usando el universo de Naruto
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear películas / arcos de la serie
        $shippuden = Movie::create([
            'name'           => 'Naruto Shippuden',
            'classification' => 'action',
            'release_date'   => '2007-02-15',
            'review'         => 'La continuación épica de Naruto, con batallas más intensas y una historia profunda sobre la amistad y el sacrificio.',
            'season'         => 1,
        ]);

        $boruto = Movie::create([
            'name'           => 'Boruto: Naruto Next Generations',
            'classification' => 'action',
            'release_date'   => '2017-04-05',
            'review'         => 'La nueva generación de ninjas enfrenta amenazas modernas mientras vive a la sombra de sus padres legendarios.',
            'season'         => 1,
        ]);

        $lastMovie = Movie::create([
            'name'           => 'The Last: Naruto the Movie',
            'classification' => 'drama',
            'release_date'   => '2014-12-06',
            'review'         => 'Una historia de amor entre Naruto y Hinata mientras salvan al mundo de la luna que cae hacia la Tierra.',
            'season'         => null, // Es una película, no una serie
        ]);

        // Crear personajes y asociarlos a sus apariciones
        $naruto = Character::create([
            'name'        => 'Naruto Uzumaki',
            'picture'     => 'https://example.com/images/naruto.jpg',
            'description' => 'El séptimo Hokage de Konoha. Ex-jinchūriki del Kyūbi, conocido por nunca rendirse y su sello de las Marcas Espirales.',
        ]);
        $naruto->movies()->sync([$shippuden->id, $boruto->id, $lastMovie->id]);

        $sasuke = Character::create([
            'name'        => 'Sasuke Uchiha',
            'picture'     => 'https://example.com/images/sasuke.jpg',
            'description' => 'El último Uchiha sobreviviente. Rival y mejor amigo de Naruto, portador del Sharingan y el Rinnegan.',
        ]);
        $sasuke->movies()->sync([$shippuden->id, $boruto->id, $lastMovie->id]);

        $sakura = Character::create([
            'name'        => 'Sakura Haruno',
            'picture'     => 'https://example.com/images/sakura.jpg',
            'description' => 'Médico ninja excepcional, alumna de la Sannin Tsunade. Parte del Equipo 7 original.',
        ]);
        $sakura->movies()->sync([$shippuden->id, $lastMovie->id]);

        $borutoChar = Character::create([
            'name'        => 'Boruto Uzumaki',
            'picture'     => 'https://example.com/images/boruto.jpg',
            'description' => 'Hijo de Naruto Uzumaki. Portador del Kāma, destinado a enfrentarse a los Ōtsutsuki.',
        ]);
        $borutoChar->movies()->sync([$boruto->id]);
    }
}
