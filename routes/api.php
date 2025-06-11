<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\ChamadoController;
use App\Http\Controllers\Api\ChamadoRespostaController;

Route::apiResource('clientes', ClienteController::class);
Route::apiResource('chamados', ChamadoController::class);
Route::apiResource('respostas', ChamadoRespostaController::class);