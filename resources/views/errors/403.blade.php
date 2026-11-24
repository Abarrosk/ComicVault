@extends('layouts.frontOffice')

@section('title', 'Acesso Proibido')

@section('content')

    <div class="text-center mt-5">

        <h1 class="text-danger">403 - Acesso Proibido</h1>

        <p class="mt-3">
            Não tens permissões para aceder a esta página
            ou executar esta operação.
        </p>

        <a href="{{ route('home') }}" class="btn btn-primary mt-3">
            Voltar à Página Inicial
        </a>

    </div>

@endsection
