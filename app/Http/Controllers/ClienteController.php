<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Helpers\AppHelper;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    /**
     * Exibe uma lista do recurso.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index')->with('clientes', $clientes);
    }

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

			Cliente::create($requestData);

		} catch (\PDOException $e) {

			$existingkey = "Integrity constraint violation: 1062 Duplicate entry";
			if (strpos($e->getMessage(), $existingkey) !== FALSE) {
				return redirect('clientes')->with('danger','Este cliente já foi cadastrado.');        		
			} else {
				throw $e;
			}

		}        

        //return to_route('clientes.create')->with('success', 'Adicionado com sucesso!');
    }

    /**
     * Exibe o recurso especificado.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Exibe o formulário para editar o recurso especificado.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Atualiza o recurso especificado.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove o recurso especificado.
     */
    public function destroy(string $id)
    {
        //
    }
}
