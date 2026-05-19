<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AreaController;
use App\Http\Controllers\TemaController;
use App\Http\Controllers\NivelController;
use App\Http\Controllers\AtividadeController;
use App\Http\Controllers\ProgressoController;
use App\Http\Controllers\SubtemaController;

Route::get('/areas', [AreaController::class, 'index']);

Route::get('/temas', [TemaController::class, 'index']);
Route::get('/temas/{area}', [TemaController::class, 'porArea']);

Route::get('/subtemas/{tema}', [SubtemaController::class, 'porTema']);

Route::get('/niveis/{subtema}', [NivelController::class, 'porSubtema']);

Route::get('/atividades/{nivel}', [AtividadeController::class, 'porNivel']);

Route::post('/progresso', [ProgressoController::class, 'store']);

Route::get('/progresso/{crianca}', [ProgressoController::class, 'progressoCrianca']);

Route::post('/progresso/verificar', [ProgressoController::class, 'verificarNivel']);