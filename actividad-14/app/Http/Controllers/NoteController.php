<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

// Controlador de recursos para el API de notas
class NoteController extends Controller
{
    // Devuelve todas las notas
    public function index()
    {
        $notes = Note::all();

        return response()->json($notes, 200);
    }

    // Crea una nueva nota con validación
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'author'         => 'required|string|max:255',
            'body'           => 'required|string',
            'classification' => 'required|in:personal,work,school,other',
        ]);

        $note = Note::create($validated);

        // 201 Created indica que el recurso fue creado exitosamente
        return response()->json($note, 201);
    }

    // Muestra una nota específica por su ID
    public function show(string $id)
    {
        $note = Note::find($id);

        // Si no existe, retorna error 404
        if (!$note) {
            return response()->json(['message' => 'Nota no encontrada'], 404);
        }

        return response()->json($note, 200);
    }

    // Actualiza una nota existente
    public function update(Request $request, string $id)
    {
        $note = Note::find($id);

        if (!$note) {
            return response()->json(['message' => 'Nota no encontrada'], 404);
        }

        // 'sometimes' permite actualizaciones parciales (no todos los campos son obligatorios)
        $validated = $request->validate([
            'title'          => 'sometimes|required|string|max:255',
            'author'         => 'sometimes|required|string|max:255',
            'body'           => 'sometimes|required|string',
            'classification' => 'sometimes|required|in:personal,work,school,other',
        ]);

        $note->update($validated);

        return response()->json($note, 200);
    }

    // Elimina una nota por su ID
    public function destroy(string $id)
    {
        $note = Note::find($id);

        if (!$note) {
            return response()->json(['message' => 'Nota no encontrada'], 404);
        }

        $note->delete();

        return response()->json(['message' => 'Nota eliminada correctamente'], 200);
    }
}
