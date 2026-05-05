<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;

// Controlador de recursos para personajes
class CharacterController extends Controller
{
    // Devuelve todos los personajes junto con sus películas asociadas
    public function index()
    {
        // with('movies') carga la relación para evitar el problema N+1
        $characters = Character::with('movies')->get();

        return response()->json($characters, 200);
    }

    // Crea un nuevo personaje y opcionalmente lo asocia a películas
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'picture'     => 'required|url',
            'description' => 'required|string',
            // movie_ids es un arreglo opcional de IDs de películas existentes
            'movie_ids'   => 'sometimes|array',
            'movie_ids.*' => 'integer|exists:movies,id',
        ]);

        $character = Character::create([
            'name'        => $validated['name'],
            'picture'     => $validated['picture'],
            'description' => $validated['description'],
        ]);

        // Sincroniza la relación muchos a muchos si se enviaron IDs
        if (isset($validated['movie_ids'])) {
            $character->movies()->sync($validated['movie_ids']);
        }

        // Carga las películas para incluirlas en la respuesta
        $character->load('movies');

        return response()->json($character, 201);
    }

    // Muestra un personaje específico con sus películas
    public function show(string $id)
    {
        $character = Character::with('movies')->find($id);

        if (!$character) {
            return response()->json(['message' => 'Personaje no encontrado'], 404);
        }

        return response()->json($character, 200);
    }

    // Actualiza un personaje existente
    public function update(Request $request, string $id)
    {
        $character = Character::find($id);

        if (!$character) {
            return response()->json(['message' => 'Personaje no encontrado'], 404);
        }

        $validated = $request->validate([
            'name'        => 'sometimes|required|string|max:255',
            'picture'     => 'sometimes|required|url',
            'description' => 'sometimes|required|string',
            'movie_ids'   => 'sometimes|array',
            'movie_ids.*' => 'integer|exists:movies,id',
        ]);

        $character->update(array_filter($validated, fn($key) => $key !== 'movie_ids', ARRAY_FILTER_USE_KEY));

        // Actualiza las asociaciones si se enviaron nuevos IDs
        if (isset($validated['movie_ids'])) {
            $character->movies()->sync($validated['movie_ids']);
        }

        $character->load('movies');

        return response()->json($character, 200);
    }

    // Elimina un personaje (las filas del pivote se eliminan en cascada)
    public function destroy(string $id)
    {
        $character = Character::find($id);

        if (!$character) {
            return response()->json(['message' => 'Personaje no encontrado'], 404);
        }

        $character->delete();

        return response()->json(['message' => 'Personaje eliminado correctamente'], 200);
    }
}
