<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Helpers\AppHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{

    /**
     * Exibe o formulário para criar um novo recurso.
     */
    public function create()
    {

        $estados = AppHelper::estados();

        return view('clientes.create', compact('estados'));
    }

    /**
     * Armazena um novo recurso.
     */
    public function store(StoreClienteRequest $request)
    {

            $requestData = $request->validated();
            $requestData['password'] = Hash::make($requestData['password']);

		try {

			$cliente = Cliente::create($requestData);

		} catch (\PDOException $e) {

			$existingkey = "Integrity constraint violation: 1062 Duplicate entry";
			if (strpos($e->getMessage(), $existingkey) !== FALSE) {
				return redirect('clientes')->with('danger','Este cliente já foi cadastrado.');        		
			} else {
				throw $e;
			}

		}        

    // Faz login automático
    Auth::guard('cliente')->login($cliente);

    // Redireciona para o painel do cliente
    return to_route('painel.dashboard')->with('success', 'Cadastro realizado com sucesso!');
    
    }

}