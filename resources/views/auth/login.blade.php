@extends('layouts.frontOffice')

@section('title', 'Iniciar Sessão')

@section('content')

    <h1>Iniciar Sessão</h1>

    <form method="POST" action="{{ route('login.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>

            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Palavra-passe</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="remember" class="form-check-input" id="remember">
            <label for="remember" class="form-check-label">
                Manter sessão iniciada
            </label>
        </div>

        <button type="submit" class="btn btn-primary">
            Entrar
        </button>
    </form>

@endsection
