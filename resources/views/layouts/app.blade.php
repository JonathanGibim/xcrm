<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'XCRM App'))</title>

    {{-- CSS do Bootstrap --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    {{-- CSS personalizados --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"> --}}

</head>
<body>

    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'XCRM App') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        
                        @guest('cliente')

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('documentacao') }}">Documentação da API</a>
                        </li>

                        @else
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('painel.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('painel.perfil') }}">Meu Perfil</a>
                        </li>

                        <li class="nav-item dropdown">
                                <a id="navbarDropdownSuporte" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Suporte</a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownSuporte">
                                    <a class="nav-link" href="{{ route('painel.chamados.create') }}">Abrir Chamado</a>
                                    <a class="nav-link" href="{{ route('painel.chamados.index') }}">Meus Chamados</a>
                                </div>
                            </li>

                        @endguest

                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @guest('cliente')
                            @if (Route::has('painel.login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('painel.login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('clientes.create'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('clientes.create') }}">Cadastre-se</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::guard('cliente')->user()->nome }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('painel.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('painel.logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        {{-- Conteúdo principal --}}
        <main class="py-4">
            
            @if ($errors->any())
            <div class="container mt-4">
                <div class="alert alert-danger">
                    <h5 class="alert-heading">Opa! Algo deu errado.</h5>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
            
            @yield('content')
        </main>

    {{-- JavaScript do Bootstrap (com Popper.js incluído no bundle) --}}
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    {{-- scripts Pushed --}}
    {{-- @stack('scripts') --}}

</body>
</html>
