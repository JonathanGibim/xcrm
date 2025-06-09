@extends('admin.layouts.app') {{-- layout principal chamado app.blade.php --}}

@section('title', 'Listagem de clientes') {{-- Opcional, para o título da página --}}

@section('content') {{-- Onde o conteúdo será inserido no layout --}}

<div class="container mt-4">
<div class="container mt-5">
    <h2 class="mb-4">Listagem de Clientes</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.clientes.create') }}" class="btn btn-primary mb-3">
        Novo Cliente
    </a>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th style="width: 150px;">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->nome }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>
                        <a href="{{ route('admin.clientes.edit', $cliente->id) }}" class="btn btn-sm btn-warning">
                            Editar
                        </a>
                        <form action="{{ route('admin.clientes.destroy', $cliente->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Tem certeza que deseja excluir este cliente?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                Excluir
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Nenhum cliente encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection