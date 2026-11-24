@extends('layouts.frontOffice')

@section('title', 'Página não encontrada')

@section('content')

    <div class="text-center py-5">

        <h1 class="display-1 fw-bold text-danger">404</h1>

        <h2>Página não encontrada</h2>

        <p class="text-muted mt-3">
            Parece que esta página não existe no ComicVault.
        </p>

        <p>
            Podes regressar à página inicial ou consultar
            a coleção de comics.
        </p>

        <div class="d-flex justify-content-center gap-3 mt-4">

            <a href="{{ route('home') }}" class="btn btn-primary">
                Página Inicial
            </a>

            <a href="{{ route('comics.all') }}" class="btn btn-outline-primary">
                Ver Comics
            </a>

        </div>

    </div>

@endsection
