<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Projeto Laravel com Bootstrap</title>

    {{-- CSS do Bootstrap --}}
    {{-- Use a versão .min.css para produção, ela é minificada --}}
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

    {{-- Seus próprios estilos CSS personalizados (opcional) --}}
    {{-- Você pode criar um arquivo style.css em public/css/ e incluir aqui --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}

</head>
<body>

    {{-- Exemplo de uso de componentes Bootstrap --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Meu App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Recursos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>Olá, Bootstrap 5 no Laravel (Sem Vite)!</h1>
        <button class="btn btn-primary">Botão de Exemplo</button>

        <div class="alert alert-success mt-3" role="alert">
            Isso é um alerta do Bootstrap!
        </div>

        {{ $slot }}
        
    </div>

    {{-- JavaScript do Bootstrap (com Popper.js incluído no bundle) --}}
    {{-- Use a versão .min.js para produção --}}
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    {{-- Seus próprios scripts JavaScript personalizados (opcional) --}}
    {{-- Você pode criar um arquivo script.js em public/js/ e incluir aqui --}}
    {{-- <script src="{{ asset('js/script.js') }}"></script> --}}

</body>
</html>
