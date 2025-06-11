<?php

namespace App\Http\Controllers\Api;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    public function index()
    {
        return response()->json(Cliente::all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:clientes',
            'password' => 'required|string|min:6',
            'telefone' => 'required|string|max:15',
            'cpf' => 'required|string|max:14|unique:clientes',
            'cep' => 'required|string|max:9',
            'estado' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'endereco' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();
        $validated['password'] = Hash::make($validated['password']);

        $cliente = Cliente::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Cliente cadastrado com sucesso.',
            'data' => $cliente,
        ], 201);
    }

    public function show($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['error' => 'Cliente não encontrado.'], 404);
        }

        return response()->json($cliente);
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['error' => 'Cliente não encontrado.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nome' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|max:255|unique:clientes,email,' . $id,
            'password' => 'sometimes|nullable|string|min:6',
            'telefone' => 'sometimes|required|string|max:15',
            'cpf' => 'sometimes|required|string|max:14|unique:clientes,cpf,' . $id,
            'cep' => 'sometimes|required|string|max:9',
            'estado' => 'sometimes|required|string|max:255',
            'cidade' => 'sometimes|required|string|max:255',
            'endereco' => 'sometimes|required|string|max:255',
            'numero' => 'sometimes|required|string|max:10',
            'complemento' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $cliente->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Cliente atualizado com sucesso.',
            'data' => $cliente,
        ]);
    }

    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['error' => 'Cliente não encontrado.'], 404);
        }

        $cliente->delete();

        return response()->json(['message' => 'Cliente removido com sucesso.'], 204);
    }
}
