<?php

namespace App\Http\Controllers\Api;

use App\Models\Chamado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ChamadoController extends Controller
{
    public function index()
    {
        return response()->json(Chamado::with('cliente')->get());
    }

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

    public function show($id)
    {
        $chamado = Chamado::with('cliente')->find($id);

        if (!$chamado) {
            return response()->json(['error' => 'Chamado não encontrado.'], 404);
        }

        return response()->json($chamado);
    }

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
