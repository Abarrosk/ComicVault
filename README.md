git commit -m "Documentar recuperacao de palavra-passe com Mailtrap Sandbox"# ComicVault

**Comic book collection management | Gestão de coleções de banda desenhada**

A Laravel web application for managing comic books and their individual issues, developed as a practical full-stack project.

Uma aplicação web Laravel para gerir comics e respetivas edições (_issues_), desenvolvida como projeto prático de desenvolvimento web.

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
- **User registration, login, password recovery/reset and protected dashboard** with a personalised greeting.
- **Mailtrap Email Sandbox** for testing password reset emails without sending messages to real inboxes.
- Shared Blade layout, role-aware navigation and custom error pages.

### Security practices

- Authentication with **Laravel Fortify**, hashed passwords and login rate limiting.
- **`auth` middleware**, server-side permission checks and conditional Blade elements.
- **CSRF protection** and server-side validation, including image type and upload-size limits.
- **TLS** for the remote database connection; credentials remain in an untracked `.env` file.

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
- **Registo, início de sessão, recuperação/redefinição de palavra-passe e Dashboard protegido**, com saudação personalizada.
- **Mailtrap Email Sandbox** para testar mensagens de recuperação de palavra-passe sem as enviar para caixas de correio reais.
- Layout Blade partilhado, navegação condicionada pelas permissões e páginas de erro personalizadas.

### Segurança

- Autenticação com **Laravel Fortify**, palavras-passe protegidas por hash e limitação de tentativas de início de sessão.
- **Middleware `auth`**, verificações de permissões no servidor e componentes Blade condicionados pelo perfil.
- **Proteção CSRF** e validação dos dados recebidos, incluindo tipo e tamanho das imagens.
- Ligação **TLS** à base de dados remota; credenciais guardadas no ficheiro `.env`, excluído do Git.
