<?php

use App\Http\Controllers\ChamadoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PainelController;
use App\Http\Controllers\ClienteAuthController;
use App\Http\Controllers\ClientePainelController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::resource('/clientes', ClienteController::class)->only('create', 'store');

// Documentação
Route::get('/documentacao', function () {
    return view('documentacao');
})->name('documentacao');

// Login
Route::get('/login', [ClienteAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [ClienteAuthController::class, 'login'])->name('login.submit');

// Logout
Route::post('/logout', [ClienteAuthController::class, 'logout'])->name('logout');

// Grupo de rotas protegidas do painel
Route::middleware('auth:cliente')->prefix('painel')->name('painel.')->group(function () { 
    
    Route::get('/', [PainelController::class, 'dashboard'])->name('dashboard');

    Route::get('/perfil', [ClientePainelController::class, 'edit'])->name('perfil');
    Route::post('/perfil', [ClientePainelController::class, 'update'])->name('perfil.update');

    Route::resource('/chamados', ChamadoController::class);
    
});