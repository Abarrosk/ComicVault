@extends('layouts.frontOffice')

@section('title', 'Editar Issue')

@section('content')

    <h1>Editar Issue</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('issues.update', $issue->id) }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Comic associado</label>
            <input type="text" class="form-control" value="{{ $comic->titulo }}" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Nome da Série</label>
            <input type="text" name="nome_serie" class="form-control" value="{{ old('nome_serie', $issue->nome_serie) }}"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Número da Edição</label>
            <input type="text" name="numero_edicao" class="form-control"
                value="{{ old('numero_edicao', $issue->numero_edicao) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Título da Issue (opcional)</label>
            <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $issue->titulo) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">ISBN (opcional)</label>
            <input type="text" name="isbn" class="form-control" value="{{ old('isbn', $issue->isbn) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Data de Publicação (opcional)</label>
            <input type="date" name="data_publicacao" class="form-control"
                value="{{ old('data_publicacao', $issue->data_publicacao) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Capa da Issue</label>

            @if ($issue->caminho_capa)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $issue->caminho_capa) }}" width="150" alt="Capa atual da issue">
                </div>
            @endif

            <input type="file" name="capa" class="form-control" accept="image/*">

            <div class="form-text">
                Se não selecionares uma nova imagem, a capa atual será mantida.
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">
                Guardar Alterações
            </button>

            <a href="{{ route('issues.show', $issue->id) }}" class="btn btn-secondary">
                Cancelar
            </a>
        </div>

    </form>

@endsection
