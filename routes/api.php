<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AreaController;
use App\Http\Controllers\TemaController;
use App\Http\Controllers\NivelController;
use App\Http\Controllers\AtividadeController;
use App\Http\Controllers\ProgressoController;
use App\Http\Controllers\SubtemaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Aqui ficam registadas as rotas da API do teu jogo escolar.
| O middleware do CORS já está ativo globalmente através do bootstrap/app.php
*/

// --- ROTAS DE ÁREAS ---
Route::get('/areas', [AreaController::class, 'index']);

// --- ROTAS DE TEMAS ---
Route::get('/temas', [TemaController::class, 'index']);
Route::get('/temas/{area}', [TemaController::class, 'porArea']);

// --- ROTAS DE SUBTEMAS (ALTERADA E CORRIGIDA) ---
// Mudámos o prefixo para o Laravel saber que estás a buscar os subtemas DE um tema específico
Route::get('/temas/{temaId}/subtemas', [SubtemaController::class, 'porTema']);

// --- ROTAS DE NÍVEIS ---
Route::get('/niveis/{subtema}', [NivelController::class, 'porSubtema']);

// --- ROTAS DE ATIVIDADES ---
Route::get('/atividades/{nivel}', [AtividadeController::class, 'porNivel']);

// --- ROTAS DE PROGRESSO DO JOGO ---
Route::post('/progresso', [ProgressoController::class, 'store']);
Route::get('/progresso/{crianca}', [ProgressoController::class, 'progressoCrianca']);
Route::post('/progresso/verificar', [ProgressoController::class, 'verificarNivel']);