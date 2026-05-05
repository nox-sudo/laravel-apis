<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

// Controlador de recursos para películas / series
class MovieController extends Controller
{
    // Devuelve todas las películas
    public function index()
    {
        $movies = Movie::all();

        return response()->json($movies, 200);
    }

    // Crea una nueva película
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'classification' => 'required|in:drama,action,suspense,other',
            'release_date'   => 'required|date',
            'review'         => 'required|string',
            // Temporada es opcional; solo aplica para series
            'season'         => 'nullable|integer|min:1',
        ]);

        $movie = Movie::create($validated);

        return response()->json($movie, 201);
    }

    // Muestra una película específica por su ID
    public function show(string $id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json(['message' => 'Película no encontrada'], 404);
        }

        return response()->json($movie, 200);
    }

    // Actualiza una película existente
    public function update(Request $request, string $id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json(['message' => 'Película no encontrada'], 404);
        }

        $validated = $request->validate([
            'name'           => 'sometimes|required|string|max:255',
            'classification' => 'sometimes|required|in:drama,action,suspense,other',
            'release_date'   => 'sometimes|required|date',
            'review'         => 'sometimes|required|string',
            'season'         => 'sometimes|nullable|integer|min:1',
        ]);

        $movie->update($validated);

        return response()->json($movie, 200);
    }

    // Elimina una película por su ID
    public function destroy(string $id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json(['message' => 'Película no encontrada'], 404);
        }

        $movie->delete();

        return response()->json(['message' => 'Película eliminada correctamente'], 200);
    }
}
