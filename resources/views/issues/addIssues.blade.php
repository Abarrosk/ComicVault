@extends('layouts.frontOffice')

@section('title', 'Adicionar Issue')

@section('content')

    <h1>Adicionar Issue</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($comics->isEmpty())
        <div class="alert alert-warning">
            Não existem comics registados.
            É necessário adicionar um comic primeiro.
        </div>
    @endif

    <form action="{{ route('issues.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="mb-3">
            <label class="form-label">Comic associado</label>

            <select name="id_comic" class="form-select" required>
                <option value="">Selecionar Comic</option>

                @foreach ($comics as $comic)
                    <option value="{{ $comic->id }}" @if (old('id_comic') == $comic->id) selected @endif>
                        {{ $comic->titulo }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Nome da Série</label>
            <input type="text" name="nome_serie" class="form-control" value="{{ old('nome_serie') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Número da Edição</label>
            <input type="text" name="numero_edicao" class="form-control" value="{{ old('numero_edicao') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Título da Issue (opcional)</label>
            <input type="text" name="titulo" class="form-control" value="{{ old('titulo') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">ISBN (opcional)</label>
            <input type="text" name="isbn" class="form-control" value="{{ old('isbn') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Data de Publicação (opcional)</label>
            <input type="date" name="data_publicacao" class="form-control" value="{{ old('data_publicacao') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Capa da Issue (opcional)</label>
            <input type="file" name="capa" class="form-control" accept="image/*">
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success" @if ($comics->isEmpty()) disabled @endif>
                Guardar Issue
            </button>

            <a href="{{ route('issues.all') }}" class="btn btn-secondary">
                Cancelar
            </a>
        </div>

    </form>

@endsection
