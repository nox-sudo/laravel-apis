<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

/*
|--------------------------------------------------------------------------
| Rutas de la API — Notas
|--------------------------------------------------------------------------
| Route::apiResource genera automáticamente las rutas RESTful:
|   GET    /notes          → index
|   POST   /notes          → store
|   GET    /notes/{id}     → show
|   PUT    /notes/{id}     → update
|   DELETE /notes/{id}     → destroy
*/

Route::apiResource('notes', NoteController::class);
