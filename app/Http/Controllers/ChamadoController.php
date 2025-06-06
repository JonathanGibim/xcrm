<?php

namespace App\Http\Controllers;

use App\Models\Chamado;
use Illuminate\Http\Request;

class ChamadoController extends Controller
{
    /**
     * Exibe uma lista do recurso.
     */
    public function index()
    {
        $chamados = Chamado::where('clientes_id', auth('cliente')->id())->latest()->get();
        return view('painel.chamados.index', compact('chamados'));
    }

    /**
     * Exibe o formulário para criar um novo recurso.
     */
    public function create()
    {
        return view('painel.chamados.create');
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
            'clientes_id' => auth('cliente')->id(),
            'assunto'     => $request->assunto,
            'descricao'   => $request->descricao,
            'prioridade'  => $request->prioridade,
            'status'      => 'aberto', // valor padrão
        ]);

        return redirect()->route(route: 'painel.chamados.index')->with('success', 'Chamado criado com sucesso!');
    }

    /**
     * Exibe o recurso especificado.
     */
    public function show(string $id)
    {
        $chamado = Chamado::findOrFail($id);

        // Você pode adicionar uma verificação se quiser garantir que o cliente só veja seus chamados:
        if (auth()->guard('cliente')->id() !== $chamado->clientes_id) {
            abort(403, 'Acesso não autorizado');
        }

        return view('painel.chamados.show', compact('chamado'));
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
