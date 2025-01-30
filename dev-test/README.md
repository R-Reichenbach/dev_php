# Teste Desenvolvedor PHP

## Descrição
O sistema de teste é uma aplicação de gestão de tarefas (to-do list), onde os usuários podem realizar o registro e login para acessar suas tarefas. A aplicação permite ao usuário listar, adicionar, editar e deletar suas tarefas. Além disso, a previsão do tempo de Birigui é integrada via API para fornecer informações úteis aos usuários em tempo real.

## Tecnologias Usadas
- **Backend**: Laravel, PHP
- **Frontend**: HTML, CSS, JavaScript
- **Banco de Dados**: MySQL
- **Gerenciamento de Dependências**: Composer
- **API Externa**: Previsão do tempo (Birigui)

## Funcionalidades
- Registro de usuário e login.
- Listagem de tarefas de cada usuário logado.
- CRUD de tarefas (Adicionar, Editar, Deletar e Listar).
- Integração com a API de previsão do tempo de Birigui.
- Validação de e-mail único durante o registro.
- Validação de senha (confirmação da senha ao cadastrar).
- Proteção de rotas com middleware para garantir que o usuário esteja autenticado.

## Instruções para Instalação

### Pré-requisitos
1. Instalar o **PHP** e o **Composer**.
2. Instalar o **XAMPP** (ou outro servidor local) para conectar ao banco de dados e executar o **phpMyAdmin**.
3. Configurar o banco de dados no **phpMyAdmin** (detalhes no arquivo `.env`).

### Passos para rodar o sistema
1. Clone este repositório:

    ```bash
    git clone <URL_DO_REPOSITORIO>
    ```

2. Navegue até o diretório do projeto:

    ```bash
    cd dev-test
    ```

3. Instale as dependências do Composer:

    ```bash
    composer install
    ```

4. Configure o arquivo `.env` com as informações do banco de dados (nome do banco, usuário, senha e porta).

5. Execute o comando para instalar as dependências do NPM:

    ```bash
    npm install
    ```

6. No XAMPP, inicie o **Apache** e o **MySQL**.

7. Crie um banco de dados no **phpMyAdmin** com as configurações definidas no `.env`.

8. Execute as migrações para criar as tabelas do banco de dados:

    ```bash
    php artisan migrate
    ```

9. Agora, o sistema está pronto para ser executado.

### Como utilizar
- Acesse a aplicação via navegador e faça o login ou o registro de um novo usuário.
- Após o login, você será redirecionado para a página onde pode gerenciar suas tarefas.

