# Data Analysis API

API para coleta, armazenamento e análise de dados, desenvolvida em Laravel 10 com autenticação via Sanctum.

---

## 📋 Requisitos

-   PHP 8.1 ou superior
-   Composer
-   MySQL
-   Laravel 10

---

## 🚀 Como Configurar

1. **Clone o repositório:**

    ```bash
    git clone https://github.com/isacfc45/data-analysis-api.git
    cd data-analysis-api
    ```

2. **Instale as dependências:**

    ```bash
    composer install
    ```

3. **Configure o ambiente:**

    - Crie uma cópia do arquivo `.env.example` e renomeie para `.env`.
    - Configure as variáveis de ambiente no arquivo `.env`, especialmente as relacionadas ao banco de dados:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nome_do_banco
    DB_USERNAME=seu_usuario
    DB_PASSWORD=sua_senha
    ```

4. **Gere a chave do Laravel:**

    ```bash
    php artisan key:generate
    ```

5. **Execute as migrations:**

    ```bash
    php artisan migrate
    ```

6. **Instale o Laravel Sanctum:**

    ```bash
    php artisan sanctum:install
    php artisan migrate
    ```

7. **Execute o servidor:**

    ```bash
    php artisan serve
    ```

8. **Acesse a API:**
    - O servidor estará disponível em: [http://localhost:8000](http://localhost:8000)

---

## 📚 Documentação da API

A documentação da API foi gerada usando o Scribe. Para acessar:

1. **Gere a documentação:**

    ```bash
    php artisan scribe:generate
    ```

2. **Acesse a documentação no navegador:**
    - [http://localhost:8000/docs](http://localhost:8000/docs)

---

## 🛠 Endpoints

### 🔐 Autenticação

-   **Registrar usuário:** `POST /api/register`
-   **Fazer login:** `POST /api/login`
-   **Fazer logout:** `POST /api/logout`

### 💼 Vendas

-   **Listar vendas:** `GET /api/sales`
-   **Criar venda:** `POST /api/sales`
-   **Detalhes da venda:** `GET /api/sales/{id}`
-   **Atualizar venda:** `PUT /api/sales/{id}`
-   **Excluir venda:** `DELETE /api/sales/{id}`

### 📊 Métricas

-   **Total de vendas:** `GET /api/sales/total`
-   **Média de vendas por dia:** `GET /api/sales/average`
-   **Vendas por produto:** `GET /api/sales/by-product`
-   **Vendas por período:** `GET /api/sales/by-period`

---

## 🧪 Testes

Para executar os testes automatizados:

```bash
php artisan test
```

---

## 🛠️ Tecnologias Utilizadas

-   **Laravel 10:** Framework PHP para desenvolvimento web.
-   **Laravel Sanctum:** Autenticação via tokens.
-   **MySQL:** Banco de dados relacional.
-   **Scribe:** Geração de documentação da API.
-   **PHPUnit:** Testes automatizados.

---

## 🤝 Como Contribuir

1. Faça um fork do projeto.
2. Crie uma branch para sua feature:
    ```bash
    git checkout -b minha-feature
    ```
3. Commit suas alterações:
    ```bash
    git commit -m 'Adicionando nova feature'
    ```
4. Envie para o repositório remoto:
    ```bash
    git push origin minha-feature
    ```
5. Abra um pull request.

---

### **Como Usar**

1. Crie um arquivo chamado `README.md` na raiz do seu projeto.
2. Copie e cole o conteúdo acima no arquivo.
3. Substitua os placeholders (ex.: `seu-usuario`, `isac@example.com`) pelas suas informações.
4. Adicione o arquivo ao repositório Git:
    ```bash
    git add README.md
    git commit -m "Adiciona README.md"
    git push origin main
    ```
