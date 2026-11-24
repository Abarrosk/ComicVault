<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('batman.png') }}">

    <title>@yield('title', 'ComicVault')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- Menu de navegação -->
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
        <div class="container-fluid">

            <!-- Nome da aplicação: regressa sempre à Homepage -->
            <a class="navbar-brand" href="{{ route('home') }}">
                ComicVault
            </a>

            <!-- Botão do menu em ecrãs pequenos -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarComicVault">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarComicVault">

                <!-- Ligações do menu -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link" href="/comics">
                            Comics
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/issues">
                            Issues
                        </a>
                    </li>

                    <!-- Apenas administradores podem adicionar -->
                    @auth
                        @if (auth()->user()->tipo_utilizador == 1)
                            <li class="nav-item">
                                <a class="nav-link" href="/comics/adicionar">
                                    Adicionar Comic
                                </a>
                            </li>
                        @endif
                    @endauth

                </ul>

                <!-- Formulário de pesquisa -->

                <form action="{{ route('pesquisa.resultados') }}" method="GET" class="d-flex gap-2">

                    <input type="search" name="pesquisa" class="form-control" placeholder="Pesquisar..."
                        value="{{ request('pesquisa') }}" required>

                    <select name="campo" class="form-select">

                        <option value="nome" @if (request('campo', 'nome') == 'nome') selected @endif>
                            Nome
                        </option>

                        <option value="numero" @if (request('campo') == 'numero') selected @endif>
                            Número
                        </option>

                        <option value="isbn" @if (request('campo') == 'isbn') selected @endif>
                            ISBN
                        </option>

                    </select>

                    <button type="submit" class="btn btn-outline-light">
                        Pesquisar
                    </button>

                </form>

                <!-- Autenticação -->
                <ul class="navbar-nav ms-lg-3">

                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                Login
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                Registar
                            </a>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                Dashboard
                            </a>
                        </li>

                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="btn btn-link nav-link">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @endauth

                </ul>

            </div>
        </div>
    </nav>

    <!-- Conteúdo específico de cada página -->
    <main class="container my-4">
        @yield('content')
    </main>

    <!-- Rodapé -->
    <footer class="container text-center py-3">
        <p class="text-muted">ComicVault - Gestão de Comics</p>
    </footer>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
