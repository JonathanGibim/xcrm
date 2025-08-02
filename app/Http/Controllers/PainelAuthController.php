<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PainelAuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('cliente')->check()) {
            return redirect()->route('painel.dashboard');
        }
        return view('painel.login');
    }

    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::guard('cliente')->attempt($credentials)) {
            return redirect()->route('painel.dashboard');
        }

        return back()->withErrors(['password' => 'Email ou senha inválidos.']);

    }

    public function logout()
    {
        Auth::guard('cliente')->logout();
        return redirect()->route('painel.login');
    }
}
