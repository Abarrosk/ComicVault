@extends('layouts.frontOffice')

@section('title', 'Lista de Comics')

@section('content')

    <h1>A minha coleção de Comics</h1>

    <!-- TABELA 1: TODOS OS COMICS -->
    <h4>Todos os Comics</h4>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Capa</th>
                <th>Título</th>
                <th>Número</th>
                <th>Editor</th>
                <th>ISBN</th>
                <th>Formato</th>
                <th>N.º Issues</th>
                <th>Ações</th>

            </tr>
        </thead>

        <tbody>
            @foreach ($comics as $comic)
                <tr>
                    <td>
                        @if ($comic->caminho_capa)
                            <img src="{{ asset('storage/' . $comic->caminho_capa) }}" width="70" alt="Capa do comic">
                        @else
                            Sem capa
                        @endif
                    </td>

                    <td>{{ $comic->titulo }}</td>
                    <td>{{ $comic->numero }}</td>
                    <td>{{ $comic->editor }}</td>
                    <td>{{ $comic->isbn }}</td>
                    <td>{{ $comic->formato }}</td>
                    <td>{{ $comic->numero_issues }}</td>

                    <td>
                        <a href="{{ route('comics.show', $comic->id) }}" class="btn btn-primary btn-sm">
                            Ver detalhes
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- TABELA 2: DETALHES DO COMIC SELECIONADO -->
    @if ($comicInfo)

        <hr class="my-4">

        <h4>Detalhes do Comic</h4>

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $comicInfo->id }}</td>
                </tr>

                <tr>
                    <th>Título</th>
                    <td>{{ $comicInfo->titulo }}</td>
                </tr>

                <tr>
                    <th>Número</th>
                    <td>{{ $comicInfo->numero }}</td>
                </tr>

                <tr>
                    <th>Editor</th>
                    <td>{{ $comicInfo->editor }}</td>
                </tr>

                <tr>
                    <th>ISBN</th>
                    <td>{{ $comicInfo->isbn }}</td>
                </tr>

                <tr>
                    <th>Formato</th>
                    <td>{{ $comicInfo->formato }}</td>
                </tr>

                <tr>
                    <th>Descrição</th>
                    <td>{{ $comicInfo->descricao }}</td>
                </tr>

                <tr>
                    <th>Capa</th>
                    <td>
                        @if ($comicInfo->caminho_capa)
                            <img src="{{ asset('storage/' . $comicInfo->caminho_capa) }}" width="150" alt="Capa do comic">
                        @else
                            Sem capa
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Issues incluídas</th>
                    <td>
                        @if ($issuesComic->count() == 0)
                            Este comic ainda não tem issues registadas.
                        @else
                            <ul>
                                @foreach ($issuesComic as $issue)
                                    <li>
                                        <a href="{{ route('issues.show', $issue->id) }}">
                                            {{ $issue->nome_serie }}
                                            #{{ $issue->numero_edicao }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

    @endif

@endsection
