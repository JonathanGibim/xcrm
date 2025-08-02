<?php

namespace App\Http\Controllers\Api;

use App\Models\ChamadoResposta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations as OA;

class ChamadoRespostaController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/chamado-respostas",
     *     summary="Listar todas as respostas dos chamados",
     *     tags={"Chamado Respostas"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de respostas retornada com sucesso",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(response=401, description="Não autenticado")
     * )
     */
    public function index()
    {
        return response()->json(ChamadoResposta::with('chamado')->get());
    }

    /**
     * @OA\Post(
     *     path="/api/chamado-respostas",
     *     summary="Registrar nova resposta ao chamado",
     *     tags={"Chamado Respostas"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"chamado_id", "mensagem", "autor"},
     *             @OA\Property(property="chamado_id", type="integer"),
     *             @OA\Property(property="mensagem", type="string"),
     *             @OA\Property(property="autor", type="string", enum={"admin", "cliente"})
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Resposta registrada com sucesso",
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
            'chamado_id' => 'required|exists:chamados,id',
            'mensagem' => 'required|string',
            'autor' => 'required|in:admin,cliente',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $resposta = ChamadoResposta::create($validator->validated());

        return response()->json([
            'status' => true,
            'message' => 'Resposta registrada com sucesso.',
            'data' => $resposta,
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/chamado-respostas/{id}",
     *     summary="Exibir resposta específica",
     *     tags={"Chamado Respostas"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID da resposta",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Resposta encontrada",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resposta não encontrada"
     *     ),
     *     @OA\Response(response=401, description="Não autenticado")
     * )
     */
    public function show($id)
    {
        $resposta = ChamadoResposta::with('chamado')->find($id);

        if (!$resposta) {
            return response()->json(['error' => 'Resposta não encontrada.'], 404);
        }

        return response()->json($resposta);
    }

    /**
     * @OA\Put(
     *     path="/api/chamado-respostas/{id}",
     *     summary="Atualizar resposta ao chamado",
     *     tags={"Chamado Respostas"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID da resposta",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="mensagem", type="string"),
     *             @OA\Property(property="autor", type="string", enum={"admin", "cliente"})
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Resposta atualizada com sucesso",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resposta não encontrada"
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
        $resposta = ChamadoResposta::find($id);

        if (!$resposta) {
            return response()->json(['error' => 'Resposta não encontrada.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'mensagem' => 'sometimes|required|string',
            'autor' => 'sometimes|required|in:admin,cliente',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $resposta->update($validator->validated());

        return response()->json([
            'status' => true,
            'message' => 'Resposta atualizada com sucesso.',
            'data' => $resposta,
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/chamado-respostas/{id}",
     *     summary="Remover resposta de chamado",
     *     tags={"Chamado Respostas"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID da resposta",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Resposta removida com sucesso",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resposta não encontrada"
     *     ),
     *     @OA\Response(response=401, description="Não autenticado")
     * )
     */
    public function destroy($id)
    {
        $resposta = ChamadoResposta::find($id);

        if (!$resposta) {
            return response()->json(['error' => 'Resposta não encontrada.'], 404);
        }

        $resposta->delete();

        return response()->json(['message' => 'Resposta removida com sucesso.'], 204);
    }
}
