@extends('admin.layouts.app') {{-- layout principal chamado app.blade.php --}}

@section('title', 'Cadastro de Cliente') {{-- Opcional, para o título da página --}}

@section('content') {{-- Onde o conteúdo será inserido no layout --}}

<div class="container mt-4">
    <h1>Dashboard admin da XCRM </h1>    <h2>Olá, {{ Auth::user()->name }} 👋</h2>
    <p class="lead">Bem-vindo à área administrativa do XCRM.</p>

    <!-- Cards de Visão Geral -->
    <div class="row g-3 mb-4">
      <div class="col-md-4">
        <div class="card border-primary text-center">
          <div class="card-body">
            <h5 class="card-title">👥 Total de Clientes</h5>
            <p class="fs-4">{{ $totalClientes }}</p>
            <a href="{{ route('admin.clientes.index') }}" class="btn btn-sm btn-outline-primary">Ver todos</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card border-danger text-center">
          <div class="card-body">
            <h5 class="card-title">🛠️ Chamados Abertos</h5>
            <p class="fs-4">{{ $chamadosAbertos }}</p>
            <a href="{{ route('admin.chamados.index') }}" class="btn btn-sm btn-outline-danger">Ver chamados</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card border-success text-center">
          <div class="card-body">
            <h5 class="card-title">➕ Novo Cliente</h5>
            <p class="fs-4">Cadastro rápido</p>
            <a href="{{ route('admin.clientes.create') }}" class="btn btn-sm btn-outline-success">Criar cliente</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Últimos Clientes -->
    <h4 class="mt-5">Últimos Clientes Cadastrados</h4>
    <div class="table-responsive mb-4">
      <table class="table table-bordered">
        <thead class="table-light">
          <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Data de Cadastro</th>
          </tr>
        </thead>
        <tbody>
          @forelse($ultimosClientes as $cliente)
            <tr>
              <td>{{ $cliente->nome }}</td>
              <td>{{ $cliente->email }}</td>
              <td>{{ $cliente->created_at->format('d/m/Y') }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="3">Nenhum cliente cadastrado ainda.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Chamados Recentes -->
    <h4>Chamados Recentes</h4>
    <div class="table-responsive mb-4">
      <table class="table table-bordered">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>Cliente</th>
            <th>Assunto</th>
            <th>Prioridade</th>
            <th>Status</th>
            <th>Criado em</th>
            <th class="text-end">Ações</th>
          </tr>
        </thead>
        <tbody>
          @forelse($chamadosRecentes as $chamado)
            <tr>
                <td>{{ $chamado->id }}</td>
                <td>{{ $chamado->cliente->nome }}</td>
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
          @empty
            <tr>
              <td colspan="4">Nenhum chamado recente.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
</div>

@endsection