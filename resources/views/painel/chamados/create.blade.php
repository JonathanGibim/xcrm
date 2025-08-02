@extends('layouts.app') {{-- layout principal chamado app.blade.php --}}

@section('title', 'Abrir Chamado') {{-- Opcional, para o título da página --}}

@section('content') {{-- Onde o conteúdo será inserido no layout --}}

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Abrir Chamado</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('painel.chamados.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="assunto" class="form-label">Assunto</label>
                    <input type="text" class="form-control" id="assunto" name="assunto" value="{{ old('assunto') }}" required>
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="5" required>{{ old('descricao') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="prioridade" class="form-label">Prioridade</label>
                    <select class="form-select" id="prioridade" name="prioridade" required>
                        <option value="">Selecione</option>
                        <option value="baixa" {{ old('prioridade') == 'baixa' ? 'selected' : '' }}>Baixa</option>
                        <option value="media" {{ old('prioridade') == 'media' ? 'selected' : '' }}>Média</option>
                        <option value="alta" {{ old('prioridade') == 'alta' ? 'selected' : '' }}>Alta</option>
                    </select>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Salvar Chamado</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection