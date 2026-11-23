@extends('layouts.frontOffice')

@section('title', 'Dashboard')

@section('content')

    <h1>Dashboard</h1>

    <h3>Olá, {{ $utilizador->name }}!</h3>

    <p>Bem-vindo ao ComicVault.</p>

    @if ($utilizador->tipo_utilizador == 1)
        <div class="alert alert-success">
            Conta de Administrador
        </div>
    @else
        <div class="alert alert-info">
            Conta de Utilizador
        </div>
    @endif

@endsection
