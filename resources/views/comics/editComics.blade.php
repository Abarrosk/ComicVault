@extends('layouts.frontOffice')

@section('title', 'Editar Comic')

@section('content')

    <h1>Editar Comic</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('comics.update', $comic->id) }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <h4>Dados do Comic</h4>

        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $comic->titulo) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Número</label>
            <input type="text" name="numero" class="form-control" value="{{ old('numero', $comic->numero) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Editor</label>
            <input type="text" name="editor" class="form-control" value="{{ old('editor', $comic->editor) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">ISBN</label>
            <input type="text" name="isbn" class="form-control" value="{{ old('isbn', $comic->isbn) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Formato</label>
            <input type="text" name="formato" class="form-control" value="{{ old('formato', $comic->formato) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control" rows="4">{{ old('descricao', $comic->descricao) }}</textarea>
        </div>

        <hr>

        <h4>Issues incluídas</h4>

        @forelse ($issuesComic as $issue)
            <div class="border rounded p-3 mb-3">

                <h5>Issue {{ $loop->iteration }}</h5>

                <div class="mb-3">
                    <label class="form-label">Nome da Série</label>
                    <input type="text" name="issues[{{ $issue->id }}][nome_serie]" class="form-control"
                        value="{{ old('issues.' . $issue->id . '.nome_serie', $issue->nome_serie) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Número da Edição</label>
                    <input type="text" name="issues[{{ $issue->id }}][numero_edicao]" class="form-control"
                        value="{{ old('issues.' . $issue->id . '.numero_edicao', $issue->numero_edicao) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">ISBN da Issue</label>
                    <input type="text" name="issues[{{ $issue->id }}][isbn]" class="form-control"
                        value="{{ old('issues.' . $issue->id . '.isbn', $issue->isbn) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Título da Issue</label>
                    <input type="text" name="issues[{{ $issue->id }}][titulo]" class="form-control"
                        value="{{ old('issues.' . $issue->id . '.titulo', $issue->titulo) }}">
                </div>

            </div>

        @empty

            <p>Este comic não tem issues associadas.</p>
        @endforelse


        @if (Auth::user()->tipo_utilizador == 1)

            <input type="hidden" name="quantidade_novas_issues" value="{{ $quantidadeNovasIssues }}">

            @for ($i = 0; $i < $quantidadeNovasIssues; $i++)
                <div class="border rounded p-3 mb-3">

                    <h5>Nova Issue {{ $i + 1 }}</h5>

                    <div class="mb-3">
                        <label class="form-label">Nome da Série</label>
                        <input type="text" name="novas_issues[{{ $i }}][nome_serie]" class="form-control"
                            value="{{ old('novas_issues.' . $i . '.nome_serie') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Número da Edição</label>
                        <input type="text" name="novas_issues[{{ $i }}][numero_edicao]" class="form-control"
                            value="{{ old('novas_issues.' . $i . '.numero_edicao') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">ISBN (opcional)</label>
                        <input type="text" name="novas_issues[{{ $i }}][isbn]" class="form-control"
                            value="{{ old('novas_issues.' . $i . '.isbn') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Título (opcional)</label>
                        <input type="text" name="novas_issues[{{ $i }}][titulo]" class="form-control"
                            value="{{ old('novas_issues.' . $i . '.titulo') }}">
                    </div>

                </div>
            @endfor

            <button type="submit" name="acao" value="adicionar_issue" formnovalidate
                class="btn btn-outline-primary mb-4">
                + Adicionar Issue
            </button>

        @endif


        <hr>

        <h4>Capa do Comic</h4>

        @if ($comic->caminho_capa)
            <div class="mb-3">
                <img src="{{ str_starts_with($comic->caminho_capa, 'http')
                    ? $comic->caminho_capa
                    : asset('storage/' . $comic->caminho_capa) }}"
                    width="150" alt="Capa atual do comic">
            </div>
        @endif

        <div class="mb-3">
            <label class="form-label">
                Substituir capa (opcional)
            </label>

            <input type="file" name="capa" class="form-control" accept="image/*">
        </div>

        <hr>

        <div class="d-flex gap-2">

            <button type="submit" class="btn btn-success">
                Guardar Alterações
            </button>

            <a href="{{ route('comics.show', $comic->id) }}" class="btn btn-secondary">
                Cancelar
            </a>

        </div>

    </form>

@endsection
