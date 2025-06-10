<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Chamado;
use App\Models\Cliente;

class AdminController extends Controller
{
    public function index()
    {
    $totalClientes = Cliente::count();
    $chamadosAbertos = Chamado::where('status', 'aberto')->count();
    $ultimosClientes = Cliente::latest()->take(5)->get();
    $chamadosRecentes = Chamado::with('cliente')->latest()->take(5)->get();

    return view('admin.dashboard', compact(
        'totalClientes',
        'chamadosAbertos',
        'ultimosClientes',
        'chamadosRecentes'
    ));

    }
}