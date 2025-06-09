<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUpdateClienteRequest;
use App\Http\Requests\StoreClienteRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminClienteController extends Controller
{
    /**
     * Exibe uma lista do recurso.
     */
    public function index()
    {
        $clientes = Cliente::latest()->get();
        return view('admin.clientes.index', compact('clientes'));
    }
    /**
     * Exibe o formulário para criar um novo recurso.
     */
    public function create()
    {
        $estados = AppHelper::estados();
        return view('admin.clientes.create', compact('estados'));
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
            return redirect()->route(route: 'admin.clientes.index')->with('success', 'Cliente criado com sucesso!');

		} catch (\PDOException $e) {

			$existingkey = "Integrity constraint violation: 1062 Duplicate entry";
			if (strpos($e->getMessage(), $existingkey) !== FALSE) {
				return redirect('clientes')->with('danger','Este cliente já foi cadastrado.');        		
			} else {
				throw $e;
			}

		}
    
    }

    public function edit(Cliente $cliente)
    {
        $estados = AppHelper::estados();
        return view('admin.clientes.edit', compact(['cliente', 'estados']));
    }

    public function update(AdminUpdateClienteRequest $request, Cliente $cliente)
    {

        $request->validated();
        
        $cliente->fill($request->except('password', 'password_confirmation'));

        if ($request->filled('password')) {
            $cliente->password = Hash::make($request->password);
        }

        $cliente->save();

        return redirect()->back()->with('success', 'Cliente atualizado com sucesso!');
    }
    
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('admin.clientes.index')
            ->with('success', 'Cliente excluído com sucesso!');
    }
}