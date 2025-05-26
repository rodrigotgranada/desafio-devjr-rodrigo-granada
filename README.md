# 🚀 Todo App Modular (Laravel)

[![Laravel](https://img.shields.io/badge/Laravel-12.x-red?logo=laravel)](https://laravel.com/) [![License: MIT](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

🔗 **Repositório:** [github.com/rodrigotgranada/desafio-devjr-rodrigo-granada](https://github.com/rodrigotgranada/desafio-devjr-rodrigo-granada.git)

---

## ✨ Funcionalidades
- Cadastro e login de usuários
- Dashboard com resumo de produtividade
- CRUD de tarefas (criar, editar, excluir, listar, marcar como concluída)
- Estrutura modular (Auth, Tasks, Dashboard)
- Layout moderno com Tailwind CSS, Vite e Alpine.js
- Testes automatizados
- Suporte a SQLite (dev/teste) e MySQL (produção/Docker)

---

## 🛠️ Requisitos
- PHP >= 8.2
- Composer
- Node.js e npm (para assets front-end)
- **Extensões obrigatórias no `php.ini`:**
  - Certifique-se de descomentar (remover o `;` do início) as seguintes linhas:
    ```
    extension=pdo
    extension=pdo_sqlite
    extension=sqlite3
    extension=pdo_mysql
    extension=mbstring
    extension=fileinfo
    extension=openssl
    extension=tokenizer
    extension=xml
    extension=ctype
    extension=json
    extension=curl
    ```
  - Salve o arquivo e reinicie o servidor web ou terminal.

---

## 📦 Instalação e uso

1. **Clone o repositório:**
   ```bash
   git clone https://github.com/rodrigotgranada/desafio-devjr-rodrigo-granada.git
   cd desafio-devjr-rodrigo-granada
   ```
2. **Instale as dependências:**
   ```bash
   composer install
   npm install
   ```
3. **Copie o arquivo de ambiente:**
   ```bash
   cp .env.example .env
   ```
4. **Gere a chave da aplicação:**
   ```bash
   php artisan key:generate
   ```
5. **Configure o banco de dados:**
   - **SQLite (desenvolvimento):**
     ```bash
     touch database/database.sqlite
     ```
     No `.env`:
     ```
     DB_CONNECTION=sqlite
     DB_SQLITE_PATH=database/database.sqlite
     ```
   - **SQLite (tests):**
     ```bash
     touch database/database_test.sqlite
     ```
     No `.phpunit.xml`:
     ```
     <env name="DB_DATABASE" value="database/database_test.sqlite"/>
     ```
   - **MySQL (produção ou Docker):**
     Configure as variáveis no `.env` conforme necessário.

6. **Rode as migrations e seeders:**
   ```bash
   npm run migrate-seed
   ```

7. **Inicie o projeto (backend + frontend juntos):**
   ```bash
   npm run dev ou npm run start
   ```
   > Isso irá rodar `php artisan serve` e o Vite ao mesmo tempo. 

---

## 📝 Scripts úteis (`package.json`)
- `npm run dev` — Sobe Laravel + Vite juntos (desenvolvimento)
- `npm run dev:laravel` — Sobe só o backend
- `npm run dev:vite` — Sobe só o frontend (Vite)
- `npm run build` — Gera os assets para produção
- `npm run test` — Executa os testes automatizados

---

## 🧪 Testes

- **Testes automatizados:**  
  ```bash
  npm run test
  ```
- **Banco de dados de testes (isolado):**  
  Os testes automatizados usam um banco separado:  
  `database/database_test.sqlite`
  
  Para criar ou resetar manualmente:
  ```bash
  touch database/database_test.sqlite
  php artisan migrate --env=testing
  ```
  O Laravel isola o banco de desenvolvimento do banco de testes.

---

## 🗂️ Estrutura modular
- `app/Modules/Auth` — Autenticação e usuários
- `app/Modules/Tasks` — Tarefas
- `app/Modules/Dashboard` — Dashboard (apenas views)

---

## 🐳 Docker
- Possui `docker-compose.yml` para MySQL.
- Rode:
  ```bash
  docker-compose up -d
  ```
- Ajuste o `.env` para usar o MySQL do container, se necessário.

---

## 💡 Considerações técnicas
- Arquitetura modular para fácil manutenção e testes.
- Banco de dados flexível (SQLite/MySQL).
- Front-end desacoplado (Tailwind, Vite, Alpine.js).
- Testes automatizados para autenticação, cadastro, tarefas, etc.

---

