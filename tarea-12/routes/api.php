<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\MovieController;

/*
|--------------------------------------------------------------------------
| Rutas de la API — Personajes y Películas
|--------------------------------------------------------------------------
| Rutas generadas por apiResource:
|
|   GET    /characters          → index   (lista con películas incluidas)
|   POST   /characters          → store
|   GET    /characters/{id}     → show    (incluye películas)
|   PUT    /characters/{id}     → update
|   DELETE /characters/{id}     → destroy
|
|   GET    /movies              → index
|   POST   /movies              → store
|   GET    /movies/{id}         → show
|   PUT    /movies/{id}         → update
|   DELETE /movies/{id}         → destroy
*/

Route::apiResource('characters', CharacterController::class);
Route::apiResource('movies', MovieController::class);
