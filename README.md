# Sistema de Login com JWT em PHP

Este é um projeto simples que demonstra a autenticação de usuários utilizando **JWT (JSON Web Tokens)** com **PHP puro** e **MySQL**, seguindo boas práticas de estrutura de diretórios para projetos web.

## 🔐 Funcionalidades

- Login de usuário com geração de JWT
- Codificação manual do token (header, payload, assinatura)
- Validação de token em páginas protegidas
- Senha com hash seguro (recomendado: `password_hash()` / `password_verify()`)
- Acesso protegido com sessão

## 📁 Estrutura do Projeto

```
jwt-login-php/
├── public/
│   ├── index.html          # Página de login
│   ├── login.php           # Processa login e gera JWT
│   └── protected/
│       └── dashboard.php   # Página protegida (requer JWT válido)
│
├── src/
│   ├── config/
│   │   └── database.php     # Conexão com o banco de dados
│   └── auth/
│       └── verify-token.php # Validação do token JWT
│
└── README.md
```

## 🛠 Requisitos

- PHP 7.4 ou superior
- MySQL
- XAMPP (ou outro servidor Apache + MySQL)

## ⚙️ Como configurar com XAMPP

1. Copie o projeto para o diretório `htdocs` do XAMPP:

   ```
   C:\xampp\htdocs\jwt-login-php\
   ```

2. Crie o banco de dados MySQL:

   ```sql
   CREATE DATABASE jwt;
   ```

3. Crie a tabela e adicione um usuário de teste:

   ```sql
   CREATE TABLE users (
       id INT AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(50) NOT NULL,
       password VARCHAR(255) NOT NULL
   );

   INSERT INTO users (username, password)
   VALUES ('usuario', SHA2('senha123', 256)); -- Em produção, use password_hash()
   ```

4. Edite o arquivo `src/config/database.php` com suas credenciais do MySQL:

   ```php
   $host = 'localhost';
   $dbname = 'jwt';
   $user = 'root';
   $pass = '';
   ```

5. Inicie o Apache e o MySQL pelo XAMPP.

6. Acesse no navegador:
   ```
   http://localhost/jwt-login-php/public/index.html
   ```

## ✅ Melhorias Futuras

- [ ] Usar `password_hash()` e `password_verify()` no lugar de `SHA2`
- [ ] Armazenar a chave secreta JWT em `.env` ou fora da raiz pública
- [ ] Adicionar funcionalidade de logout e renovação de token
- [ ] Usar uma biblioteca JWT como [`firebase/php-jwt`](https://github.com/firebase/php-jwt)
<hr>
