@extends('layouts.frontOffice')

@section('title', 'Lista de Issues')

@section('content')

    <h1>A minha coleção de Issues</h1>

    <!-- TABELA 1: TODAS AS ISSUES -->
    <h4>Todas as Issues</h4>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Capa</th>
                <th>Nome da Série</th>
                <th>N.º Edição</th>
                <th>Título</th>
                <th>Comic</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($issues as $issue)
                <tr>
                    <td>
                        @if ($issue->caminho_capa)
                            <img src="{{ asset('storage/' . $issue->caminho_capa) }}" width="70" alt="Capa da issue">
                        @else
                            Sem capa
                        @endif
                    </td>

                    <td>{{ $issue->nome_serie }}</td>
                    <td>{{ $issue->numero_edicao }}</td>
                    <td>{{ $issue->titulo }}</td>
                    <td>{{ $issue->titulo_comic }}</td>

                    <td>
                        <a href="{{ route('issues.show', $issue->id) }}" class="btn btn-primary btn-sm">
                            Ver detalhes
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- TABELA 2: DETALHES DA ISSUE SELECIONADA -->
    @if ($issueInfo)

        <hr class="my-4">

        <h4>Detalhes da Issue</h4>

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $issueInfo->id }}</td>
                </tr>

                <tr>
                    <th>Nome da Série</th>
                    <td>{{ $issueInfo->nome_serie }}</td>
                </tr>

                <tr>
                    <th>N.º Edição</th>
                    <td>{{ $issueInfo->numero_edicao }}</td>
                </tr>

                <tr>
                    <th>Título</th>
                    <td>{{ $issueInfo->titulo }}</td>
                </tr>

                <tr>
                    <th>Data de Publicação</th>
                    <td>{{ $issueInfo->data_publicacao }}</td>
                </tr>

                <tr>
                    <th>ISBN</th>
                    <td>{{ $issueInfo->isbn }}</td>
                </tr>

                <tr>
                    <th>Comic associado</th>
                    <td>
                        <a href="{{ route('comics.show', $issueInfo->id_comic) }}">
                            {{ $issueInfo->titulo_comic }}
                        </a>
                    </td>
                </tr>

                <tr>
                    <th>Capa</th>
                    <td>
                        @if ($issueInfo->caminho_capa)
                            <img src="{{ asset('storage/' . $issueInfo->caminho_capa) }}" width="150"
                                alt="Capa da issue">
                        @else
                            Sem capa
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

    @endif

@endsection
