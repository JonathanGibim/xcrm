<?php

namespace App\Http\Controllers\Api;

use App\Models\Chamado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations as OA;

class ChamadoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/chamados",
     *     summary="Listar todos os chamados",
     *     tags={"Chamados"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de chamados retornada com sucesso",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(response=401, description="Não autenticado")
     * )
     */
    public function index()
    {
        return response()->json(Chamado::with('cliente')->get());
    }

    /**
     * @OA\Post(
     *     path="/api/chamados",
     *     summary="Criar novo chamado",
     *     tags={"Chamados"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"clientes_id", "assunto", "descricao", "prioridade", "status"},
     *             @OA\Property(property="clientes_id", type="integer"),
     *             @OA\Property(property="assunto", type="string"),
     *             @OA\Property(property="descricao", type="string"),
     *             @OA\Property(property="prioridade", type="string", enum={"baixa", "media", "alta"}),
     *             @OA\Property(property="status", type="string", enum={"aberto", "respondido", "fechado"})
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Chamado criado com sucesso",
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
            'clientes_id' => 'required|exists:clientes,id',
            'assunto' => 'required|string',
            'descricao' => 'required|string',
            'prioridade' => 'required|in:baixa,media,alta',
            'status' => 'required|in:aberto,respondido,fechado',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $chamado = Chamado::create($validator->validated());

        return response()->json([
            'status' => true,
            'message' => 'Chamado criado com sucesso.',
            'data' => $chamado,
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/chamados/{id}",
     *     summary="Exibir um chamado",
     *     tags={"Chamados"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do chamado",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Chamado encontrado",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Chamado não encontrado"
     *     ),
     *     @OA\Response(response=401, description="Não autenticado")
     * )
     */
    public function show($id)
    {
        $chamado = Chamado::with('cliente')->find($id);

        if (!$chamado) {
            return response()->json(['error' => 'Chamado não encontrado.'], 404);
        }

        return response()->json($chamado);
    }

    /**
     * @OA\Put(
     *     path="/api/chamados/{id}",
     *     summary="Atualizar um chamado",
     *     tags={"Chamados"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do chamado",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="assunto", type="string"),
     *             @OA\Property(property="descricao", type="string"),
     *             @OA\Property(property="prioridade", type="string", enum={"baixa", "media", "alta"}),
     *             @OA\Property(property="status", type="string", enum={"aberto", "respondido", "fechado"})
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Chamado atualizado com sucesso",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Chamado não encontrado"
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
        $chamado = Chamado::find($id);

        if (!$chamado) {
            return response()->json(['error' => 'Chamado não encontrado.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'assunto' => 'sometimes|required|string',
            'descricao' => 'sometimes|required|string',
            'prioridade' => 'sometimes|required|in:baixa,media,alta',
            'status' => 'sometimes|required|in:aberto,respondido,fechado',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $chamado->update($validator->validated());

        return response()->json([
            'status' => true,
            'message' => 'Chamado atualizado com sucesso.',
            'data' => $chamado,
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/chamados/{id}",
     *     summary="Remover um chamado",
     *     tags={"Chamados"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do chamado",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Chamado removido com sucesso",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Chamado não encontrado"
     *     ),
     *     @OA\Response(response=401, description="Não autenticado")
     * )
     */
    public function destroy($id)
    {
        $chamado = Chamado::find($id);

        if (!$chamado) {
            return response()->json(['error' => 'Chamado não encontrado.'], 404);
        }

        $chamado->delete();

        return response()->json(['message' => 'Chamado removido com sucesso.'], 204);
    }
}
