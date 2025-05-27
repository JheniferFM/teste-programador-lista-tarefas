
## 📋 To-Do List Laravel — Gerenciador de Tarefas

Seja bem-vindo(a) ao **To-Do List Laravel**, uma aplicação simples e eficiente para você organizar suas tarefas diárias, com sistema completo de autenticação, gerenciamento e controle do status das suas atividades.

---

## 🚀 Sobre o Projeto

Este sistema foi desenvolvido para facilitar o gerenciamento de tarefas, onde cada usuário pode:

* Criar
* Editar
* Visualizar
* Excluir suas próprias tarefas

A aplicação oferece **filtros** e **busca** para encontrar rapidamente o que você precisa, além de garantir a **segurança** e **privacidade** das suas informações.

---

## ✨ Funcionalidades Principais

* ✅ **Cadastro, Login e Logout**: Controle completo de acesso para usuários.
* ✅ **CRUD de Tarefas**: Criar, ler, atualizar e deletar tarefas.
* ✅ **Status das Tarefas**: Controle o andamento das suas tarefas com os status `pendente`, `andamento` e `concluída`.
* ✅ **Filtros e Busca**: Encontre suas tarefas pelo título ou pelo status.
* ✅ **Paginação**: Visualize as tarefas de forma organizada e prática.
* ✅ **Segurança**: Usuários só acessam e alteram suas próprias tarefas.
* ✅ **Interface Intuitiva**: Páginas construídas com Blade para experiência fluida.


---

## 🛠️ Como Usar

### 1. Clone este repositório:

```bash
git clone https://github.com/seu-usuario/seu-repositorio.git
cd seu-repositorio
```

---

### 2. Configure o ambiente:

* Copie o arquivo `.env.example` para `.env`:

```bash
cp .env.example .env
```

* Ajuste as configurações do banco de dados para o seu ambiente local.

---

## ⚙️ Configuração do Banco de Dados

No arquivo `.env`, configure as variáveis conforme o seu ambiente:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

### ✅ Como criar o banco de dados no MySQL:

```sql
CREATE DATABASE nome_do_banco;
```

Substitua `nome_do_banco` pelo nome que você indicou no `.env`.

Após a configuração, execute as **migrations**:

```bash
php artisan migrate
```

Se quiser popular o banco com dados fictícios (se houver `seeders`):

```bash
php artisan db:seed
```

---

### 3. Instale as dependências:

```bash
composer install
```

---

### 4. Gere a chave da aplicação:

```bash
php artisan key:generate
```

---

### 5. Inicie o servidor local:

```bash
php artisan serve
```

---

### 6. Acesse no navegador:

[http://localhost:8000](http://localhost:8000)

---



