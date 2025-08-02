<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\ChamadoController;
use App\Http\Controllers\Api\ChamadoRespostaController;
use App\Http\Controllers\Api\AuthController;

// ROTA PÚBLICA (login)
Route::post('/login', [AuthController::class, 'login']);

// ROTAS PROTEGIDAS
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/perfil', [AuthController::class, 'perfil']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('clientes', ClienteController::class);
    Route::apiResource('chamados', ChamadoController::class);
    Route::apiResource('chamado-respostas', ChamadoRespostaController::class);
});

