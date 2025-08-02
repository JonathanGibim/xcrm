@extends('layouts.app') {{-- layout principal chamado app.blade.php --}}

@section('title', 'Bem vindo ao XCRM') {{-- Opcional, para o título da página --}}

@section('content') {{-- Onde o conteúdo será inserido no seu layout --}}

<!-- Hero -->
<section class="hero text-center">
    <div class="container">
        <h1 class="display-4 fw-bold">XCRM – Sistema de Suporte ao Cliente</h1>
        <p class="lead mt-3">Sistema simples de suporte com Laravel. Separado por painéis para clientes e administradores.</p>
        <div class="mt-4">
            <a href="/documentacao" class="btn btn-primary btn-lg">Ver Documentação API (Swagger)</a>
        </div>
    </div>
</section>

<!-- Funcionalidades -->
<section class="py-5">
    <div class="container">
        <h2 class="section-title">Funcionalidades</h2>
        <div class="row ">
            <div class="col-md-6 d-flex">
                <div class="card p-3 h-100 w-100">
                    <h5>Painel do Cliente</h5>
                    <ul>
                        <li>Abertura de chamados de suporte</li>
                        <li>Listagem e acompanhamento dos chamados enviados</li>
                    </ul>
                    <p>
                        <strong>Dados de Acesso</strong><br>
                        Login: demo@xweb.com.br<br>
                        Senha: 123456
                    </p>
                    <a href="/painel" class="btn btn-primary btn-lg mt-auto">Acessar Painel</a>
                </div>
            </div>
            <div class="col-md-6 d-flex">
                <div class="card p-3 h-100 w-100">
                    <h5>Painel Administrativo</h5>
                    <ul>
                        <li>Cadastro e gerenciamento de clientes</li>
                        <li>Visualização de todos os chamados</li>
                        <li>Resposta aos chamados abertos pelos clientes</li>
                        <li>Acesso a API</li>
                    </ul>
                    <p>
                        <strong>Dados de Acesso</strong><br>
                        Login: demo@xweb.com.br<br>
                        Senha: 123456
                    </p>
                    <a href="/admin" class="btn btn-dark btn-lg mt-auto">Acessar Painel</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tecnologias -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title">Tecnologias Utilizadas</h2>
        <ul class="list-inline">
            <li class="list-inline-item badge bg-secondary m-1">PHP 8.x</li>
            <li class="list-inline-item badge bg-secondary m-1">Laravel 12.x</li>
            <li class="list-inline-item badge bg-secondary m-1">MySQL</li>
            <li class="list-inline-item badge bg-secondary m-1">Blade</li>
            <li class="list-inline-item badge bg-secondary m-1">Bootstrap 5</li>
            <li class="list-inline-item badge bg-secondary m-1">Swagger</li>
        </ul>
    </div>
</section>

<!-- Como executar -->
<section class="py-5">
    <div class="container">
        <h2 class="section-title">Como Executar o Projeto</h2>
        <ol>
        <li>Clone o repositório
            <pre><code>git clone https://github.com/JonathanGibim/xcrm.git
cd xcrm</code></pre>
        </li>
        <li>Instale as dependências
            <pre><code>composer install</code></pre>
        </li>
        <li>Configure o ambiente:
            <pre><code>cp .env.example .env</code></pre>
            <p>Edite as seguintes variáveis no <code>.env</code>:</p>
            <pre><code>DB_DATABASE=xcrm
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
            </code></pre>
        </li>
        <li>Gere a chave da aplicação
            <pre><code>php artisan key:generate</code></pre>
        </li>
        <li>Execute as migrations
            <pre><code>php artisan migrate</code></pre>
        </li>
        <li>Rode o servidor local
            <pre><code>php artisan serve</code></pre>
            <p>Acesse em: <a href="http://localhost:8000" target="_blank">http://localhost:8000</a></p>
        </li>
        </ol>
    </div>
</section>

@endsection