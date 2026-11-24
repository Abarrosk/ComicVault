@extends('layouts.frontOffice')

@section('title', 'ReadMe First!')

@section('content')

    <div class="container">

        <h1 class="mb-4">ComicVault — ReadMe First!</h1>

        <!-- 1. Sobre o projeto -->
        <h2 class="h4 mt-4">1. Sobre o projeto</h2>

        <p>
            Desenvolvi o <strong>ComicVault</strong> em PHP,
            utilizando Laravel, com o objetivo de gerir uma
            coleção de comics e respetivas issues.
        </p>

        <p>
            Através desta aplicação, disponibilizo funcionalidades
            de consulta, pesquisa, adição, edição e eliminação de
            registos, de acordo com as permissões atribuídas
            a cada utilizador.
        </p>

        <hr>

        <!-- 2. Tipos de utilizador -->
        <h2 class="h4 mt-4">2. Tipos de utilizador e permissões</h2>

        <p>Defini três níveis de acesso à aplicação:</p>

        <h3 class="h5">Visitante — Sem autenticação</h3>
        <ul>
            <li>Pode consultar todos os comics e issues.</li>
            <li>Pode consultar os detalhes dos registos.</li>
            <li>Pode pesquisar por nome, número ou ISBN.</li>
            <li>Não pode adicionar, editar ou eliminar registos.</li>
        </ul>

        <h3 class="h5">Utilizador registado — tipo_utilizador = 0</h3>
        <ul>
            <li>Tem acesso a todas as funcionalidades disponíveis aos visitantes.</li>
            <li>Pode aceder ao Dashboard.</li>
            <li>Pode editar comics e issues existentes.</li>
            <li>Não pode adicionar ou eliminar comics nem criar novas issues.</li>
        </ul>

        <h3 class="h5">Administrador — tipo_utilizador = 1</h3>
        <ul>
            <li>Tem acesso a todas as funcionalidades anteriores.</li>
            <li>Pode adicionar comics e respetivas issues.</li>
            <li>Pode editar comics e issues existentes.</li>
            <li>Pode acrescentar issues a comics já registados.</li>
            <li>
                Pode eliminar comics, sendo também eliminadas
                as respetivas issues associadas.
            </li>
        </ul>

        <p>
            Para gerir a autenticação, utilizei o Laravel Fortify.
            Implementei o controlo de permissões através da autenticação
            e de verificações de acesso nos Controllers.
        </p>

        <hr>

        <!-- 3. Base de dados -->
        <h2 class="h4 mt-4">3. Base de dados — TiDB Cloud</h2>

        <p>
            Optei por utilizar uma
            <strong>base de dados remota alojada no TiDB Cloud</strong>,
            compatível com MySQL.
        </p>

        <p>
            Configurei a ligação através do ficheiro
            <code>.env</code> do Laravel, utilizando uma ligação
            segura com TLS.
        </p>

        <p>
            Utilizei o Eloquent para comunicar com a base de dados
            e as migrações do Laravel para definir a estrutura das tabelas.
        </p>

        <hr>

        <!-- 4. Imagens -->
        <h2 class="h4 mt-4">4. Armazenamento das imagens</h2>

        <p>
            Configurei o armazenamento local das capas dos comics
            na pasta:
        </p>

        <p><code>storage/app/public/comics</code></p>

        <p>
            Defini que <strong>cada comic pode ter apenas uma capa</strong>.
            Quando é selecionada uma nova imagem durante a edição,
            esta substitui a anterior.
        </p>

        <p>
            Decidi incluir as imagens no repositório GitHub para garantir
            que a professora também recebe as capas existentes ao
            descarregar o projeto.
        </p>

        <p>
            Na base de dados, guardo apenas o caminho correspondente
            a cada imagem.
        </p>

        <hr>

        <!-- 5. Instruções -->
        <h2 class="h4 mt-4">5. Instruções para executar o projeto</h2>

        <p>
            Após descarregar o projeto do GitHub, é necessário realizar
            os seguintes passos:
        </p>

        <h3 class="h5">1. Adicionar o ficheiro .env</h3>

        <p>
            Colocar na raiz do projeto o ficheiro
            <code>.env</code> que disponibilizei separadamente
            através do <strong>Microsoft Teams</strong>.
        </p>

        <p>
            Nesse ficheiro, incluí as configurações necessárias para
            estabelecer a ligação à base de dados TiDB Cloud.
        </p>

        <h3 class="h5">2. Instalar as dependências</h3>

        <p>Abrir o terminal na pasta do projeto e executar:</p>

        <pre class="bg-light border rounded p-3"><code>composer install</code></pre>

        <h3 class="h5">3. Criar a ligação simbólica das imagens</h3>

        <p>Executar:</p>

        <pre class="bg-light border rounded p-3"><code>php artisan storage:link</code></pre>

        <p>
            Este comando cria a ligação simbólica entre
            <code>public/storage</code> e
            <code>storage/app/public</code>,
            permitindo que as capas sejam apresentadas no navegador.
        </p>

        <p>
            <strong>Não é necessário voltar a executar as migrações</strong>,
            uma vez que já configurei a base de dados remota e inseri
            os registos de teste.
        </p>

        <hr>

        <!-- 6. Conta de teste -->
        <h2 class="h4 mt-4">6. Conta de administrador para testes</h2>

        <p>
            Criei uma conta de administrador para permitir testar
            as funcionalidades reservadas a este nível de acesso.
        </p>

        <ul>
            <li><strong>Email:</strong> admin@mail.com</li>
            <li><strong>Palavra-passe:</strong> disponibilizada separadamente através do Teams.</li>
            <li><strong>Tipo de utilizador:</strong> Administrador (1)</li>
        </ul>

        <p>
            Destinei esta conta exclusivamente à avaliação do projeto.
        </p>

        <hr>

        <!-- 7. Segurança -->
        <h2 class="h4 mt-4">7. Considerações sobre segurança</h2>

        <p>
            Tenho consciência de que o ficheiro <code>.env</code>
            contém credenciais e informações sensíveis que não devem
            ser publicadas num repositório público.
        </p>

        <p>
            Por esse motivo, decidi manter o <code>.env</code>
            excluído do GitHub e disponibilizá-lo à professora
            separadamente, através do Microsoft Teams.
        </p>

        <p>
            Em contrapartida, optei por incluir as imagens dos comics
            no repositório GitHub, de forma a facilitar a instalação
            e a avaliação do projeto.
        </p>

        <p>
            Tenho também consciência de que a conta de administrador
            e a respetiva palavra-passe se destinam exclusivamente
            a testes e não devem ser utilizadas num ambiente de produção.
        </p>

        <hr>
        <p class="fs-4">
            Este texto foi gerado por IA após ser explicado como o projeto foi feito e configurado.
        </p>
        <hr>
        <a href="{{ route('home') }}" class="btn btn-secondary mt-3">
            Voltar à Página Inicial
        </a>

    </div>

@endsection
