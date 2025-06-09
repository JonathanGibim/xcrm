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

    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                    {{ config('app.name', 'XCRM App') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        
                        @guest

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('documentacao') }}">Documentação da API</a>
                        </li>

                        @else
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.perfil') }}">Meu Perfil</a>
                        </li>

                        <li class="nav-item dropdown">
                                <a id="navbarDropdownSuporte" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Suporte</a>
                                <div class="dropdown-menu dropdown-menu-end navbar-dark bg-dark" aria-labelledby="navbarDropdownSuporte">
                                    <a class="nav-link" href="{{ route('admin.chamados.create') }}">Abrir Chamado</a>
                                    <a class="nav-link" href="{{ route('admin.chamados.index') }}">Todos os chamados</a>
                                </div>
                            </li>

                        @endguest

                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('admin.login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end navbar-dark bg-dark" aria-labelledby="navbarDropdown">
                                    <a class="nav-link" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
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
