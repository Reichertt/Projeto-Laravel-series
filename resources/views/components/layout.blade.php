<?php
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title}}</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-black">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="{{ route('series.index')}}">Home</a>
            @auth
                <a href="{{ route('logout')}}">Sair</a>
            @endauth
        </div>
    </nav>
    <div class="container">
        <h1>{{ $title}}</h1>

        <!-- Mensagem de sucesso-->
        @isset($mensagemSucesso)
        <div class="alert alert-success">
            {{ $mensagemSucesso }}
        </div>
        @endisset

        <!-- Mensagen de erro feito diretamente pelo Laravel-->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{ $slot}}
    </div>
</body>

</html>