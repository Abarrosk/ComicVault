# ComicVault

**Comic book collection management | Gestão de coleções de banda desenhada**

A Laravel web application for managing comic books and their individual issues, developed as a practical full-stack project.

Uma aplicação web Laravel para gerir comics e respetivas edições (*issues*), desenvolvida como projeto prático de desenvolvimento web.

**[English](#english) · [Português](#português)**

---

## English

### Technical stack and architecture

- **Back end:** PHP 8.3+, Laravel 13 and Laravel Fortify.
- **Front end:** Blade templates, HTML, CSS and Bootstrap 5 (responsive layout).
- **Database:** TiDB Cloud (MySQL-compatible relational database), accessed through **Eloquent ORM**.
- **Design patterns:** **MVC** for separation of responsibilities; **Active Record** through Eloquent models.
- **Object-oriented programming:** model and controller classes, inheritance and reusable methods.
- **Data structures:** Eloquent Collections, model objects and associative arrays for processing form data.
- **Data modelling:** one-to-many relationship between `comics` and `issues`, enforced by a foreign key with cascading deletion; versioned schema through Laravel migrations.

### Features

- **Full CRUD** for comics and issues, including individual issue management.
- **Three access levels:** guests (read-only), authenticated users (edit) and administrators (create, edit and delete).
- **Cross-entity search** by name, number or ISBN, with partial matches.
- **Image upload, display and replacement**, storing file paths in the database and cover images on Laravel's public disk.
- **User registration, login and protected dashboard** with a personalised greeting.
- Shared Blade layout, role-aware navigation and custom error pages.

### Security practices

- Authentication with **Laravel Fortify**, hashed passwords and login rate limiting.
- **`auth` middleware**, server-side permission checks and conditional Blade elements.
- **CSRF protection** and server-side validation, including image type and upload-size limits.
- **TLS** for the remote database connection; credentials remain in an untracked `.env` file.

### Local setup

Requires PHP 8.3+, Composer and valid TiDB Cloud connection settings (including the TLS CA certificate). Configure these privately in `.env`.

```bash
composer install
php artisan storage:link
php artisan serve
```

The existing remote database already contains the project's schema and sample data; no additional migration is required when connecting to that provisioned database. Images are served through Laravel's public storage symbolic link.

---

## Português

### Tecnologias e arquitetura

- **Back-end:** PHP 8.3+, Laravel 13 e Laravel Fortify.
- **Front-end:** templates Blade, HTML, CSS e Bootstrap 5 (interface adaptável).
- **Base de dados:** TiDB Cloud (base de dados relacional compatível com MySQL), acedida através do **Eloquent ORM**.
- **Padrões de desenho:** **MVC**, para separação de responsabilidades, e **Active Record**, através dos Models Eloquent.
- **Programação orientada a objetos:** classes para Models e Controllers, herança e métodos reutilizáveis.
- **Estruturas de dados:** Eloquent Collections, objetos dos Models e arrays associativos no tratamento dos formulários.
- **Modelo relacional:** relação um-para-muitos entre `comics` e `issues`, com chave estrangeira e eliminação em cascata; estrutura definida por migrações Laravel.

### Funcionalidades

- **CRUD completo** de comics e issues, incluindo gestão individual de cada issue.
- **Três níveis de acesso:** visitantes (consulta), utilizadores autenticados (edição) e administradores (criação, edição e eliminação).
- **Pesquisa transversal** por nome, número ou ISBN, incluindo correspondências parciais.
- **Carregamento, visualização e substituição de capas**, com caminhos guardados na base de dados e imagens no disco público do Laravel.
- **Registo, início de sessão e Dashboard protegido**, com saudação personalizada.
- Layout Blade partilhado, navegação condicionada pelas permissões e páginas de erro personalizadas.

### Segurança

- Autenticação com **Laravel Fortify**, palavras-passe protegidas por hash e limitação de tentativas de início de sessão.
- **Middleware `auth`**, verificações de permissões no servidor e componentes Blade condicionados pelo perfil.
- **Proteção CSRF** e validação dos dados recebidos, incluindo tipo e tamanho das imagens.
- Ligação **TLS** à base de dados remota; credenciais guardadas no ficheiro `.env`, excluído do Git.

### Execução local

Requer PHP 8.3+, Composer e as configurações de acesso ao TiDB Cloud, incluindo o certificado TLS. Estas configurações devem ser introduzidas de forma privada no ficheiro `.env`.

```bash
composer install
php artisan storage:link
php artisan serve
```

A base de dados remota disponibilizada já contém o esquema e os registos de teste, pelo que não é necessário executar novamente as migrações ao utilizar essa base de dados. As imagens são apresentadas através da ligação simbólica do armazenamento público do Laravel.
