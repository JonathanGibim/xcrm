<?php

use App\Http\Controllers\AdminChamadoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;

// Painel
use App\Http\Controllers\ChamadoController;
use App\Http\Controllers\PainelController;
use App\Http\Controllers\ClienteAuthController;
use App\Http\Controllers\ClientePainelController;

// Admin
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// Home
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Criar cliente
Route::resource('/clientes', ClienteController::class)->only('create', 'store');

// Documentação
Route::get('/documentacao', function () {
    return view('documentacao');
})->name('documentacao');


// Grupo de rotas do painel
Route::prefix('painel')->name('painel.')->group(function () {

    // Login
    Route::get('login', [ClienteAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [ClienteAuthController::class, 'login'])->name('login.submit');

    // Logout
    Route::post('logout', [ClienteAuthController::class, 'logout'])->name('logout');

    // Grupo de rotas protegidas do painel
    Route::middleware('auth:cliente')->group(function () {
        
        Route::get('/', [PainelController::class, 'dashboard'])->name('dashboard');

        Route::get('/perfil', [ClientePainelController::class, 'edit'])->name('perfil');
        Route::post('/perfil', [ClientePainelController::class, 'update'])->name('perfil.update');

        Route::resource('/chamados', ChamadoController::class);

    });

});


// Grupo de rotas do admin
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Login
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit');

    // Logout
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Grupo de rotas protegidas do admin
    Route::middleware('auth')->group(function () {

        Route::get('/', [AdminController::class, 'index'])->name('dashboard');

        Route::get('/perfil', [UserController::class, 'edit'])->name('perfil');
        Route::post('/perfil', [UserController::class, 'update'])->name('perfil.update');

        Route::resource('/chamados', AdminChamadoController::class)->only('index', 'create', 'store', 'show');

        Route::post('/chamados/{chamado}/responder', [AdminChamadoController::class, 'responder'])->name('chamados.responder');
        Route::post('/chamados/{chamado}/fechar', [AdminChamadoController::class, 'fechar'])->name('chamados.fechar');


    });

});