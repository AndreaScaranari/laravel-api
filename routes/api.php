<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TypeProjectController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\TechnologyProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{slug}', [ProjectController::class, 'show']);
// Route::post('/projects', [ProjectController::class, 'store']);
// Route::put('/projects/{project}', [ProjectController::class, 'update']);
// Route::delete('/projects/{project}', [ProjectController::class, 'destroy']);

// Route::apiResource('projects', ProjectController::class);

// * Rotta per i progetti legati a una tipologia
Route::get('/types/{slug}/projects', TypeProjectController::class);

// * Rotta per i progetti legati a una tecnhologia
Route::get('/technologies/{slug}/projects', TechnologyProjectController::class);

// * Rotta per ricevere un messaggio inviato(POST) da un utente
Route::post('/contact-message', [ContactController::class, 'message']);