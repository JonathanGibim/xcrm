<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/clientes', ClienteController::class)->only('create', 'store');
Route::resource('/documentacao', ClienteController::class)->only('index');

Route::resource('/login', ClienteController::class)->only('index');

Route::resource('/tickets', ClienteController::class);