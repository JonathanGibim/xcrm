<?php

namespace App\Http\Controllers\Api;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations as OA;

class ClienteController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/clientes",
     *     summary="Listar todos os clientes",
     *     tags={"Clientes"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de clientes retornada com sucesso",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(response=401, description="Não autenticado")
     * )
     */
    public function index()
    {
        return response()->json(Cliente::all());
    }

    /**
     * @OA\Post(
     *     path="/api/clientes",
     *     summary="Criar novo cliente",
     *     tags={"Clientes"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nome", "email", "password", "telefone", "cpf", "cep", "estado", "cidade", "endereco", "numero"},
     *             @OA\Property(property="nome", type="string"),
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="password", type="string"),
     *             @OA\Property(property="telefone", type="string"),
     *             @OA\Property(property="cpf", type="string"),
     *             @OA\Property(property="cep", type="string"),
     *             @OA\Property(property="estado", type="string"),
     *             @OA\Property(property="cidade", type="string"),
     *             @OA\Property(property="endereco", type="string"),
     *             @OA\Property(property="numero", type="string"),
     *             @OA\Property(property="complemento", type="string", nullable=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Cliente criado com sucesso",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erro de validação"
     *     ),
     *     @OA\Response(response=401, description="Não autenticado")
     * )
     */
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

    /**
     * @OA\Get(
     *     path="/api/clientes/{id}",
     *     summary="Exibir um cliente",
     *     tags={"Clientes"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do cliente",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Cliente encontrado",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cliente não encontrado"
     *     ),
     *     @OA\Response(response=401, description="Não autenticado")
     * )
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['error' => 'Cliente não encontrado.'], 404);
        }

        return response()->json($cliente);
    }

    /**
     * @OA\Put(
     *     path="/api/clientes/{id}",
     *     summary="Atualizar um cliente",
     *     tags={"Clientes"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do cliente",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nome", type="string"),
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="password", type="string"),
     *             @OA\Property(property="telefone", type="string"),
     *             @OA\Property(property="cpf", type="string"),
     *             @OA\Property(property="cep", type="string"),
     *             @OA\Property(property="estado", type="string"),
     *             @OA\Property(property="cidade", type="string"),
     *             @OA\Property(property="endereco", type="string"),
     *             @OA\Property(property="numero", type="string"),
     *             @OA\Property(property="complemento", type="string", nullable=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Cliente atualizado com sucesso",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cliente não encontrado"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erro de validação"
     *     ),
     *     @OA\Response(response=401, description="Não autenticado")
     * )
     */
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

    /**
     * @OA\Delete(
     *     path="/api/clientes/{id}",
     *     summary="Remover um cliente",
     *     tags={"Clientes"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do cliente",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Cliente removido com sucesso",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cliente não encontrado"
     *     ),
     *     @OA\Response(response=401, description="Não autenticado")
     * )
     */
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
