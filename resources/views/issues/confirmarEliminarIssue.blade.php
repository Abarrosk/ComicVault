@extends('layouts.frontOffice')

@section('title', 'Eliminar Issue')

@section('content')

    <h1>Eliminar Issue</h1>

    <div class="alert alert-danger">

        <h4>Confirmar eliminação</h4>

        <p>
            Tens a certeza de que pretendes eliminar a issue
            <strong>{{ $issue->nome_serie }} #{{ $issue->numero_edicao }}</strong>?
        </p>

        <p>
            O comic associado e as restantes issues não serão eliminados.
        </p>

        <strong>Esta operação não pode ser anulada.</strong>

    </div>

    <form action="{{ route('issues.destroy', $issue->id) }}" method="POST">

        @csrf
        @method('DELETE')

        <div class="d-flex gap-2">

            <button type="submit" class="btn btn-danger">
                Confirmar Eliminação
            </button>

            <a href="{{ route('issues.show', $issue->id) }}" class="btn btn-secondary">
                Cancelar
            </a>

        </div>

    </form>

@endsection
