<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/clientes', ClienteController::class);
Route::resource('/tickets', ClienteController::class);