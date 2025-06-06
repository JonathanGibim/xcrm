<?php

namespace App\Http\Controllers;

class PainelController extends Controller
{
    public function dashboard()
    {
        return view('painel.dashboard');
    }

    public function perfil()
    {
        return view('painel.perfil');
    }

}
