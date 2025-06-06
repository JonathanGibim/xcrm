@extends('layouts.app') {{-- layout principal chamado app.blade.php --}}

@section('title', 'Meu Perfil') {{-- Opcional, para o título da página --}}

@section('content') {{-- Onde o conteúdo será inserido no layout --}}

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Meu Perfil</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('painel.perfil.update') }}">
                @csrf

                {{-- Seção de Dados Pessoais --}}
                <fieldset class="mb-4 p-3 border rounded">
                    <legend class="float-none w-auto px-2 fs-5">Dados Pessoais</legend>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nome" class="form-label">Nome Completo</label>
                            <input type="text" class="form-control" value="{{ old('nome', $cliente->nome) }}" id="nome" name="nome" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{ old('email', $cliente->email) }}" id="email" name="email" required>
                        </div>
                        <div class="col-md-6">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="tel" class="form-control" value="{{ old('telefone', $cliente->telefone) }}" id="telefone" name="telefone" required>
                        </div>
                        <div class="col-md-6">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" class="form-control" value="{{ old('cpf', $cliente->cpf) }}" id="cpf" name="cpf" required>
                        </div>
                    </div>
                </fieldset>

                {{-- Seção de Endereço --}}
                <fieldset class="mb-4 p-3 border rounded">
                    <legend class="float-none w-auto px-2 fs-5">Endereço</legend>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="cep" class="form-label">CEP</label>
                            <input type="text" class="form-control" value="{{ old('cep', $cliente->cep) }}" id="cep" name="cep" required>
                        </div>
                        <div class="col-md-4">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="estado" name="estado" required>
                                <option value="">Selecione um estado</option>
                                @foreach($estados as $sigla => $nome)
                                    <option value="{{ $sigla }}" {{ (old('estado', $cliente->estado) == $sigla) ? 'selected' : '' }}>{{ $nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="cidade" class="form-label">Cidade</label>
                            <input type="text" class="form-control" value="{{ old('cidade', $cliente->cidade) }}" id="cidade" name="cidade" required>
                        </div>
                        <div class="col-md-8">
                            <label for="endereco" class="form-label">Endereço</label>
                            <input type="text" class="form-control" value="{{ old('endereco', $cliente->endereco) }}" id="endereco" name="endereco" required>
                        </div>
                        <div class="col-md-4">
                            <label for="numero" class="form-label">Número</label>
                            <input type="text" class="form-control" value="{{ old('numero', $cliente->numero) }}" id="numero" name="numero" required>
                        </div>
                        <div class="col-md-12">
                            <label for="complemento" class="form-label">Complemento</label>
                            <input type="text" class="form-control" value="{{ old('complemento', $cliente->complemento) }}" id="complemento" name="complemento">
                        </div>
                    </div>
                </fieldset>

                {{-- Seção de Senha --}}
                <fieldset class="mb-4 p-3 border rounded">
                    <legend class="float-none w-auto px-2 fs-5">Alterar Senha (Opcional)</legend>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="password" class="form-label">Nova Senha</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                    </div>
                </fieldset>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

{{-- scripts --}}
@include('partials.cep-auto-completar')
@include('partials.mascaras')
