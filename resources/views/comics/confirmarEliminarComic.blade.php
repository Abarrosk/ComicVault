@extends('layouts.frontOffice')

@section('title', 'Eliminar Comic')

@section('content')

    <h1>Eliminar Comic</h1>

    <div class="alert alert-danger">

        <h4>Confirmar eliminação</h4>

        <p>
            Tens a certeza de que pretendes eliminar
            o comic <strong>{{ $comic->titulo }}</strong>?
        </p>

        <p>
            Este comic tem
            <strong>{{ $numeroIssues }}</strong>
            issues associadas.
        </p>

        <p>
            Ao eliminar o comic, as suas issues
            também serão eliminadas.
        </p>

        <strong>Esta operação não pode ser anulada.</strong>

    </div>

    <form action="{{ route('comics.destroy', $comic->id) }}" method="POST">

        @csrf
        @method('DELETE')

        <div class="d-flex gap-2">

            <button type="submit" class="btn btn-danger">
                Confirmar Eliminação
            </button>

            <a href="{{ route('comics.show', $comic->id) }}" class="btn btn-secondary">
                Cancelar
            </a>

        </div>

    </form>

@endsection
