@extends('layouts.app') {{-- layout principal chamado app.blade.php --}}

@section('title', 'Cadastro de Cliente') {{-- Opcional, para o título da página --}}

@section('content') {{-- Onde o conteúdo será inserido no layout --}}

<div class="container mt-4">

    <h2>Olá, {{ Auth::guard('cliente')->user()->nome }} 👋</h2>
    <p class="lead">Bem-vindo ao seu painel no XCRM.</p>

    <!-- Cards principais -->
    <div class="row g-3 mb-4">
      <div class="col-md-6">
        <div class="card border-info">
          <div class="card-body text-center">
            <h5 class="card-title">👤 Meu Perfil</h5>
            <p class="card-text">
              Nome: {{ Auth::guard('cliente')->user()->nome }}<br>
              E-mail: {{ Auth::guard('cliente')->user()->email }}
            </p>
            <a href="{{ route('painel.perfil') }}" class="btn btn-sm btn-outline-info">Editar perfil</a>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card border-warning">
          <div class="card-body text-center">
            <h5 class="card-title">🛠️ Suporte</h5>
            <p class="card-text fs-4">
              {{ $chamadosEmAberto }} chamado(s) em aberto
            </p>
            <a href="{{ route('painel.chamados.index') }}" class="btn btn-sm btn-outline-warning">Ver chamados</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Ações rápidas -->
    <h4>Ações Rápidas</h4>
    <div class="d-flex flex-wrap gap-2 mb-4">
      <a href="{{ route('painel.chamados.create') }}" class="btn btn-warning">🛠️ Abrir Chamado</a>
      <a href="{{ route('painel.perfil') }}" class="btn btn-info text-white">✏️ Atualizar Perfil</a>
    </div>

    <!-- Alertas -->
    @if(session('alerta'))
      <div class="alert alert-danger">
        ⚠️ {{ session('alerta') }}
      </div>
    @endif

    @if(!Auth::user()->telefone)
      <div class="alert alert-info">
        📢 Adicione seu telefone ao perfil para completar seus dados.
      </div>
    @endif

</div>

@endsection