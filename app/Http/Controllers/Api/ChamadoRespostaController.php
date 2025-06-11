<?php

namespace App\Http\Controllers\Api;

use App\Models\ChamadoResposta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ChamadoRespostaController extends Controller
{
    public function index()
    {
        return response()->json(ChamadoResposta::with('chamado')->get());
    }

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

    public function show($id)
    {
        $resposta = ChamadoResposta::with('chamado')->find($id);

        if (!$resposta) {
            return response()->json(['error' => 'Resposta não encontrada.'], 404);
        }

        return response()->json($resposta);
    }

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
