<?php

namespace App\Http\Controllers;

use App\Models\Chamado;
use App\Models\ChamadoResposta;
use App\Models\Cliente;
use Illuminate\Http\Request;

class AdminChamadoController extends Controller
{
    /**
     * Exibe uma lista do recurso.
     */
    public function index()
    {
        $chamados = Chamado::latest()->get();
        return view('admin.chamados.index', compact('chamados'));
    }

    /**
     * Exibe o formulário para criar um novo recurso.
     */
    public function create()
    {
        $clientes = Cliente::all();
        return view('admin.chamados.create', compact('clientes'));
    }

    /**
     * Armazena um novo recurso.
     */
    public function store(Request $request)
    {
        $request->validate([
            'assunto'    => 'required|string|max:255',
            'descricao'  => 'required|string',
            'prioridade' => 'required|in:baixa,media,alta',
        ]);
        
        $chamado = Chamado::create([
            'clientes_id' => $request->cliente_id,
            'assunto'     => $request->assunto,
            'descricao'   => $request->descricao,
            'prioridade'  => $request->prioridade,
            'status'      => 'aberto', // valor padrão
        ]);

        return redirect()->route(route: 'admin.chamados.index')->with('success', 'Chamado criado com sucesso!');
    }

    /**
     * Exibe o recurso especificado.
     */
    public function show(string $id)
    {
        $chamado = Chamado::findOrFail($id);
        return view('admin.chamados.show', compact('chamado'));
    }

    public function responder(Request $request, Chamado $chamado)
    {
        $request->validate([
            'mensagem' => 'required|string',
        ]);

        ChamadoResposta::create([
            'chamado_id' => $chamado->id,
            'mensagem' => $request->mensagem,
            'autor' => 'admin',
        ]);

        // opcional: atualizar status do chamado
        $chamado->update(['status' => 'respondido']);

        return back()->with('success', 'Resposta enviada com sucesso!');
    }

    public function fechar(Chamado $chamado)
    {
        $chamado->update(['status' => 'fechado']);
        return redirect()->route(route: 'admin.chamados.index')->with('success', 'Chamado fechado com sucesso.');
    }

}
