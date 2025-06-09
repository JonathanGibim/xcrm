<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateClienteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PainelClienteController extends Controller
{
    public function edit()
    {
        $estados = AppHelper::estados();
        $cliente = Auth::guard('cliente')->user();
        return view('painel.perfil', compact(['cliente', 'estados']));
    }

    public function update(UpdateClienteRequest $request)
    {
        $cliente = Auth::guard('cliente')->user();

        $request->validated();

        $cliente->fill($request->except('password', 'password_confirmation'));

        if ($request->filled('password')) {
            $cliente->password = Hash::make($request->password);
        }

        $cliente->save();

        return redirect()->back()->with('success', 'Perfil atualizado com sucesso!');
    }
}
