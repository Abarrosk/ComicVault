@extends('layouts.frontOffice')

@section('title', 'Nova Palavra-passe')

@section('content')

    <h1>Definir Nova Palavra-passe</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">

        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="mb-3">
            <label class="form-label">Email</label>

            <input type="email" name="email" class="form-control" value="{{ old('email', $request->email) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nova Palavra-passe</label>

            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Confirmar Nova Palavra-passe</label>

            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">
            Alterar Palavra-passe
        </button>

    </form>

@endsection
