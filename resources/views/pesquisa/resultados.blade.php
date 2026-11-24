@extends('layouts.frontOffice')

@section('title', 'Resultados da Pesquisa')

@section('content')

    <h1>Resultados da Pesquisa</h1>

    <p>
        Pesquisa por <strong>{{ ucfirst($campo) }}</strong>:
        <strong>{{ $pesquisa }}</strong>
    </p>

    <div class="row g-4">

        <!-- COLUNA ESQUERDA: COMICS -->
        <div class="col-12 col-lg-6">

            <h4>
                Comics encontrados ({{ $comics->count() }})
            </h4>

            @if ($comics->count() > 0)

                <div class="table-responsive">
                    <table class="table table-striped table-hover">

                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>N.º</th>
                                <th>ISBN</th>
                                <th>Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($comics as $comic)
                                <tr>
                                    <td>{{ $comic->titulo }}</td>
                                    <td>{{ $comic->numero }}</td>
                                    <td>{{ $comic->isbn }}</td>

                                    <td>
                                        <a href="{{ route('comics.show', $comic->id) }}" class="btn btn-primary btn-sm">
                                            Ver detalhes
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    Não foram encontrados comics.
                </div>

            @endif

        </div>

        <!-- COLUNA DIREITA: ISSUES -->
        <div class="col-12 col-lg-6">

            <h4>
                Issues encontradas ({{ $issues->count() }})
            </h4>

            @if ($issues->count() > 0)

                <div class="table-responsive">
                    <table class="table table-striped table-hover">

                        <thead>
                            <tr>
                                <th>Nome da Série</th>
                                <th>N.º</th>
                                <th>ISBN</th>
                                <th>Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($issues as $issue)
                                <tr>
                                    <td>
                                        {{ $issue->nome_serie }}

                                        @if ($issue->titulo)
                                            <div class="text-muted small">
                                                {{ $issue->titulo }}
                                            </div>
                                        @endif
                                    </td>

                                    <td>{{ $issue->numero_edicao }}</td>
                                    <td>{{ $issue->isbn }}</td>

                                    <td>
                                        <a href="{{ route('issues.show', $issue->id) }}" class="btn btn-primary btn-sm">
                                            Ver detalhes
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    Não foram encontradas issues.
                </div>

            @endif

        </div>

    </div>

@endsection
