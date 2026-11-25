@extends('layouts.frontOffice')

@section('title', 'Página Inicial')

@section('content')

    <div class="text-center mb-5">
        <h1>Bem-vindo ao ComicVault</h1>
        <p>Gestão da minha coleção de comics.</p>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <!-- Bloco 2: All Comics -->
        <div class="col">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-body p-4">
                    <h3 class="card-title">All Comics</h3>
                    <p class="card-text">
                        Consulta todos os comics disponíveis na coleção.
                    </p>
                    <a href="{{ route('comics.all') }}" class="btn btn-primary">
                        Ver Comics
                    </a>
                </div>
            </div>
        </div>

        <!-- Bloco 3: All Issues -->
        <div class="col">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-body p-4">
                    <h3 class="card-title">All Issues</h3>
                    <p class="card-text">
                        Consulta todas as issues registadas.
                    </p>
                    <a href="{{ route('issues.all') }}" class="btn btn-primary">
                        Ver Issues
                    </a>
                </div>
            </div>
        </div>

        <!-- Bloco 4: Dashboard -->
        <div class="col">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-body p-4">
                    <h3 class="card-title">Dashboard</h3>
                    <p class="card-text">
                        Acede à tua área de utilizador.
                    </p>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">
                        Abrir Dashboard
                    </a>
                </div>
            </div>
        </div>

    </div>

@endsection
