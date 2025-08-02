@extends('admin.layouts.app') {{-- layout principal chamado app.blade.php --}}

@section('title', 'Meus Chamados') {{-- Opcional, para o título da página --}}

@section('content') {{-- Onde o conteúdo será inserido no seu layout --}}

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Todos os chamados</h4>
            <a href="{{ route('admin.chamados.create') }}" class="btn btn-light btn-sm">Abrir Chamado</a>
        </div>

        <div class="card-body p-0">
            @if($chamados->isEmpty())
                <div class="p-4">
                    <p class="text-muted mb-0">Nenhum chamado encontrado.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Assunto</th>
                                <th>Prioridade</th>
                                <th>Status</th>
                                <th>Criado em</th>
                                <th class="text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($chamados as $chamado)
                                <tr>
                                    <td>{{ $chamado->id }}</td>
                                    <td>{{ $chamado->assunto }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($chamado->prioridade == 'alta') bg-danger
                                            @elseif($chamado->prioridade == 'media') bg-warning text-dark
                                            @else bg-info @endif">
                                            {{ ucfirst($chamado->prioridade) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge 
                                            @if($chamado->status == 'aberto') bg-primary
                                            @elseif($chamado->status == 'respondido') bg-warning text-dark
                                            @else bg-success @endif">
                                            {{ ucfirst($chamado->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $chamado->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.chamados.show', $chamado->id) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection