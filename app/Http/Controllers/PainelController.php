<?php

namespace App\Http\Controllers;

use App\Models\Chamado;
use Illuminate\Support\Facades\Auth;

class PainelController extends Controller
{
    public function dashboard()
    {
        $cliente = Auth::guard('cliente')->user();
        $chamadosEmAberto = Chamado::where('clientes_id', $cliente->id)->where('status', 'aberto')->count();
        return view('painel.dashboard', compact('chamadosEmAberto'));
    }

    public function perfil()
    {
        return view('painel.perfil');
    }

}
