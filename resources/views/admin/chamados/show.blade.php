@extends('admin.layouts.app') {{-- layout principal chamado app.blade.php --}}

@section('title', 'Detalhes do Chamado') {{-- Opcional, para o título da página --}}

@section('content') {{-- Onde o conteúdo será inserido no layout --}}

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Chamado #{{ $chamado->id }}</h4>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Assunto:</dt>
                <dd class="col-sm-9">{{ $chamado->assunto }}</dd>

                <dt class="col-sm-3">Descrição:</dt>
                <dd class="col-sm-9">{{ $chamado->descricao }}</dd>

                <dt class="col-sm-3">Prioridade:</dt>
                <dd class="col-sm-9 text-capitalize">{{ $chamado->prioridade }}</dd>

                <dt class="col-sm-3">Status:</dt>
                <dd class="col-sm-9 text-capitalize">{{ $chamado->status }}</dd>

                <dt class="col-sm-3">Data de Criação:</dt>
                <dd class="col-sm-9">{{ $chamado->created_at->format('d/m/Y H:i') }}</dd>
            </dl>

            <h3>Respostas</h3>
            @foreach($chamado->respostas as $resposta)
                <div class="mt-2">
                    <small>{{ $resposta->created_at->format('d/m/Y H:i') }}</small> - <strong>{{ $resposta->autor === 'admin' ? 'Suporte' : 'Cliente' }}</strong>: 
                    <br>
                    {{ $resposta->mensagem }}
                </div>
            @endforeach

            <hr>

            <form action="{{ route('admin.chamados.responder', $chamado->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                <textarea class="form-control" name="mensagem" rows="4" placeholder="Digite sua resposta" required></textarea>
                <button type="submit" class="btn btn-dark mt-2">Enviar Resposta</button>
                </div>
            </form>

            <div class="d-flex justify-content-end">
                @if($chamado->status !== 'fechado')
                    <form action="{{ route('admin.chamados.fechar', $chamado->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success me-3" onclick="return confirm('Tem certeza que deseja fechar este chamado?')">
                            Fechar Chamado
                        </button>
                    </form>
                @endif
                <a href="{{ route('admin.chamados.index') }}" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
    </div>
</div>

@endsection