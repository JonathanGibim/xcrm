<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Rules\CpfValido;

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

        $estados = [
            'AC' => 'Acre',
            'AL' => 'Alagoas',
            'AP' => 'Amapá',
            'AM' => 'Amazonas',
            'BA' => 'Bahia',
            'CE' => 'Ceará',
            'DF' => 'Distrito Federal',
            'ES' => 'Espírito Santo',
            'GO' => 'Goiás',
            'MA' => 'Maranhão',
            'MT' => 'Mato Grosso',
            'MS' => 'Mato Grosso do Sul',
            'MG' => 'Minas Gerais',
            'PA' => 'Pará',
            'PB' => 'Paraíba',
            'PR' => 'Paraná',
            'PE' => 'Pernambuco',
            'PI' => 'Piauí',
            'RJ' => 'Rio de Janeiro',
            'RN' => 'Rio Grande do Norte',
            'RS' => 'Rio Grande do Sul',
            'RO' => 'Rondônia',
            'RR' => 'Roraima',
            'SC' => 'Santa Catarina',
            'SP' => 'São Paulo',
            'SE' => 'Sergipe',
            'TO' => 'Tocantins',
        ];

        return view('clientes.create', compact('estados'));
    }

    /**
     * Armazena um novo recurso.
     */
    public function store(Request $request)
    {

            //$requestData = $request->all();
            $request->validate([
                'nome' => 'required|string|min:3|max:255',
                'email' => 'required|email|unique:clientes,email',
                'telefone' => 'required|string|max:20',
                'cpf' => ['required','string','max:14','unique:clientes,cpf', new CpfValido],
                'cep' => 'required|string|max:9',
                'estado' => 'required|string|max:2',
                'cidade' => 'required|string|max:255',
                'endereco' => 'required|string|max:255',
                'numero' => 'required|string|max:10',
                'complemento' => 'nullable|string|max:255',
            ]);

		try {

			Cliente::create($request->all());

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
