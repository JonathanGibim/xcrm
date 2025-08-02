@extends('admin.layouts.app')

@section('title', 'Meu Perfil')

@section('content')

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Meu Perfil</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.perfil.update') }}">
                @csrf

                {{-- Dados do Usuário --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>

                {{-- Alteração de Senha (Opcional) --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Nova Senha (opcional)</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar Nova Senha</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>

                <button type="submit" class="btn btn-dark">Salvar Alterações</button>
            </form>
        </div>
    </div>
</div>

@endsection
