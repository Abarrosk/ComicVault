@extends('layouts.frontOffice')

@section('title', 'Adicionar Comic')

@section('content')

    <h1>Adicionar Comic</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('comics.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <input type="hidden" name="quantidade_issues" value="{{ $quantidadeIssues }}">

        <h4>Dados do Comic</h4>

        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" value="{{ old('titulo') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Número do Comic (opcional)</label>
            <input type="text" name="numero" class="form-control" value="{{ old('numero') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Editor</label>
            <input type="text" name="editor" class="form-control" value="{{ old('editor') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">ISBN</label>
            <input type="text" name="isbn" class="form-control" value="{{ old('isbn') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Formato</label>
            <input type="text" name="formato" class="form-control" value="{{ old('formato') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control" rows="4">{{ old('descricao') }}</textarea>
        </div>

        <hr>

        <h4>Issues incluídas</h4>

        @for ($i = 0; $i < $quantidadeIssues; $i++)
            <div class="border rounded p-3 mb-3">

                <h5>Issue {{ $i + 1 }}</h5>

                <div class="mb-3">
                    <label class="form-label">Nome da Série</label>
                    <input type="text" name="issues[{{ $i }}][nome_serie]" class="form-control"
                        value="{{ old('issues.' . $i . '.nome_serie') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Número da Edição</label>
                    <input type="text" name="issues[{{ $i }}][numero_edicao]" class="form-control"
                        value="{{ old('issues.' . $i . '.numero_edicao') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">ISBN da Issue (opcional)</label>
                    <input type="text" name="issues[{{ $i }}][isbn]" class="form-control"
                        value="{{ old('issues.' . $i . '.isbn') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Título da Issue</label>
                    <input type="text" name="issues[{{ $i }}][titulo]" class="form-control"
                        value="{{ old('issues.' . $i . '.titulo') }}">
                </div>




            </div>
        @endfor

        <button type="submit" name="acao" value="adicionar_issue" formnovalidate class="btn btn-outline-primary mb-4">
            + Adicionar Issue
        </button>

        <hr>

        <!-- IMAGENS: PREENCHER APENAS NO FINAL -->

        <h4>Imagens (opcionais)</h4>

        <div class="mb-3">
            <label class="form-label">Capa do Comic</label>
            <input type="file" name="capa" class="form-control" accept="image/*">
        </div>

        <hr>

        <button type="submit" name="acao" value="guardar" class="btn btn-success">
            Guardar Comic
        </button>

    </form>

@endsection
