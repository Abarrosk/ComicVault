@extends('layouts.frontOffice')

@section('title', 'Recuperar Palavra-passe')

@section('content')

    <h1>Recuperar Palavra-passe</h1>

    <p>
        Introduz o email associado à tua conta para receberes
        uma ligação de recuperação da palavra-passe.
    </p>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">

        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>

            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">
            Enviar ligação de recuperação
        </button>

        <a href="{{ route('login') }}" class="btn btn-secondary">
            Voltar ao Login
        </a>

    </form>

@endsection
