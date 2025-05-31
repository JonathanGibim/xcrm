@extends('layouts.app') {{-- layout principal chamado app.blade.php --}}

@section('title', 'Cadastro de Cliente') {{-- Opcional, para o título da página --}}

@section('content') {{-- Onde o conteúdo será inserido no layout --}}

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Cadastro de Cliente</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('clientes.store') }}" method="POST">
                @csrf {{-- Diretiva do Laravel para proteção CSRF --}}

                {{-- Seção de Dados Pessoais --}}
                <fieldset class="mb-4 p-3 border rounded">
                    <legend class="float-none w-auto px-2 fs-5">Dados Pessoais</legend>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nome" class="form-label">Nome Completo</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="col-md-6">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="tel" class="form-control" id="telefone" name="telefone" placeholder="(XX) XXXXX-XXXX" pattern="[0-9]{2} [0-9]{5}-[0-9]{4}" title="Formato: (XX) XXXXX-XXXX" required>
                        </div>
                        <div class="col-md-6">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="XXX.XXX.XXX-XX" pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}" title="Formato: XXX.XXX.XXX-XX" required>
                        </div>
                    </div>
                </fieldset>

                {{-- Seção de Endereço --}}
                <fieldset class="mb-4 p-3 border rounded">
                    <legend class="float-none w-auto px-2 fs-5">Endereço</legend>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="cep" class="form-label">CEP</label>
                            <input type="text" class="form-control" id="cep" name="cep" placeholder="XXXXX-XXX" pattern="[0-9]{5}-[0-9]{3}" title="Formato: XXXXX-XXX" required>
                        </div>
                        <div class="col-md-4">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="estado" name="estado" required>
                                <option value="">Selecione um estado</option>
                                @foreach($estados as $sigla => $nome)
                                    <option value="{{ $sigla }}">{{ $nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="cidade" class="form-label">Cidade</label>
                            <input type="text" class="form-control" id="cidade" name="cidade" required>
                        </div>
                        <div class="col-md-8">
                            <label for="endereco" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Rua, Avenida, etc." required>
                        </div>
                        <div class="col-md-4">
                            <label for="numero" class="form-label">Número</label>
                            <input type="text" class="form-control" id="numero" name="numero" required>
                        </div>
                        <div class="col-md-12">
                            <label for="complemento" class="form-label">Complemento (Opcional)</label>
                            <input type="text" class="form-control" id="complemento" name="complemento">
                        </div>
                    </div>
                </fieldset>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="reset" class="btn btn-secondary me-md-2">Limpar</button>
                    <button type="submit" class="btn btn-primary">Salvar Cliente</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

{{-- scripts para cep auto-completar - API viacep --}}
@include('partials.cep-auto-completar')

{{-- scripts para máscaras de input - jquery-3.7.1 e jquery.mask --}}
@include('partials.mascaras')