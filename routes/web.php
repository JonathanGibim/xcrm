<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;

// Painel
use App\Http\Controllers\PainelController;
use App\Http\Controllers\PainelAuthController;
use App\Http\Controllers\PainelClienteController;
use App\Http\Controllers\PainelChamadoController;

// Admin
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminClienteController;
use App\Http\Controllers\AdminChamadoController;

// Home
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Documentação
Route::get('/documentacao', function () {
    return view('documentacao');
})->name('documentacao');

// Criar cliente
Route::resource('/clientes', ClienteController::class)->only('create', 'store');

// Grupo de rotas do painel do cliente
Route::prefix('painel')->name('painel.')->group(function () {

    // Login
    Route::get('login', [PainelAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [PainelAuthController::class, 'login'])->name('login.submit');

    // Logout
    Route::post('logout', [PainelAuthController::class, 'logout'])->name('logout');

    // Grupo de rotas protegidas do painel do cliente
    Route::middleware('auth:cliente')->group(function () {
        
        Route::get('/', [PainelController::class, 'dashboard'])->name('dashboard');

        Route::get('/perfil', [PainelClienteController::class, 'edit'])->name('perfil');
        Route::post('/perfil', [PainelClienteController::class, 'update'])->name('perfil.update');

        Route::resource('/chamados', PainelChamadoController::class);

    });

});


// Grupo de rotas do painel administrativo
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Login
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('login.submit');

    // Logout
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Grupo de rotas protegidas do painel administrativo
    Route::middleware('auth')->group(function () {

        Route::get('/', [AdminController::class, 'index'])->name('dashboard');

        Route::get('/perfil', [AdminUserController::class, 'edit'])->name('perfil');
        Route::post('/perfil', [AdminUserController::class, 'update'])->name('perfil.update');

        Route::resource('/chamados', AdminChamadoController::class)->only('index', 'create', 'store', 'show');
        
        Route::post('/chamados/{chamado}/responder', [AdminChamadoController::class, 'responder'])->name('chamados.responder');
        Route::post('/chamados/{chamado}/fechar', [AdminChamadoController::class, 'fechar'])->name('chamados.fechar');

        Route::resource('/clientes', AdminClienteController::class);

    });

});