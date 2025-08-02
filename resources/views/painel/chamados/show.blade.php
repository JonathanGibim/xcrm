@extends('layouts.app') {{-- layout principal chamado app.blade.php --}}

@section('title', 'Detalhes do Chamado') {{-- Opcional, para o título da página --}}

@section('content') {{-- Onde o conteúdo será inserido no layout --}}

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
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

            @if(count($chamado->respostas) > 0)
                <h3>Respostas</h3>
                @foreach($chamado->respostas as $resposta)
                    <div class="mt-2">
                        <small>{{ $resposta->created_at->format('d/m/Y H:i') }}</small> - <strong>{{ $resposta->autor === 'admin' ? 'Suporte' : 'Cliente' }}</strong>: 
                        <br>
                        {{ $resposta->mensagem }}
                    </div>
                @endforeach
            @endif

            <hr>

            @if($chamado->status != 'fechado')
                <form action="{{ route('painel.chamados.responder', $chamado) }}" method="POST">
                    @csrf
                    <textarea name="mensagem" class="form-control" required></textarea>
                    <button type="submit" class="btn btn-primary mt-2">Responder</button>
                </form>
            @endif

            <div class="d-flex justify-content-end">
                <a href="{{ route('painel.chamados.index') }}" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
    </div>
</div>

@endsection