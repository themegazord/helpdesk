- `app/`: Contém a parte da aplicação, como controladores, serviços e middlewares.
    - `Http/Controllers/`: Controladores que lidam com as requisições HTTP.
    - `Services/`: Contém os serviços da aplicação, como regras de negócios.
    - `Providers/`: Provedores de serviços da aplicação.

- `domain/`: Contém a implementação do domínio, seguindo as diretrizes do DDD.
    - `User/`: Exemplo de uma entidade do domínio "Usuário".
        - `User.php`: Representa a entidade de Usuário.
        - `UserRepository.php`: Define a interface para o repositório do Usuário.
        - `UserService.php`: Implementa a lógica do serviço do domínio.
        - `Events/`: Eventos de domínio relacionados ao Usuário.

- `infrastructure/`: Lida com a infraestrutura, como persistência e serviços externos.
    - `Persistence/Repositories/`: Implementações concretas dos repositórios do domínio.
    - `Persistence/Migrations/`: Migrations do banco de dados.

- `resources/`: Recursos da aplicação, como vistas e ativos.

- `routes/`: Define as rotas da aplicação.

- `tests/`: Contém os testes automatizados.

- `config/`: Arquivos de configuração da aplicação.

- `.env`: Arquivo de configuração de ambiente.

- `composer.json`: Arquivo de configuração do Composer.
