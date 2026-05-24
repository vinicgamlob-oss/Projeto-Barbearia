

# Projeto Barbearia

## 📖 Descrição

Este projeto é uma API desenvolvida com **Laravel** para o gerenciamento de clientes e agendamentos. A API utiliza autenticação via Laravel Sanctum e segue os padrões de desenvolvimento RESTful.

---

## 🚀 Como instalar e rodar o projeto

1. **Clonar o repositório:**
```bash
git clone <https://github.com/vinicgamlob-oss/Projeto-Barbearia>
cd <sistema-barbearia>

```


2. **Instalar dependências:**
```bash
composer install

```


3. **Configurar o ambiente:**
```bash
cp .env.example .env
php artisan key:generate

```


4. **Configurar o banco de dados:**
* Crie um banco de dados no seu gerenciador (MySQL).
* Abra o arquivo `.env` e ajuste as variáveis:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_seu_banco
DB_USERNAME=root
DB_PASSWORD=sua_senha

```




5. **Executar migrações:**
```bash
php artisan migrate

```


6. **Rodar a aplicação:**
```bash
php artisan serve

```



---

## 📧 Configurações de E-mail

O sistema está configurado para logar o envio de e-mails, facilitando o desenvolvimento sem precisar de um servidor de e-mail real.
No seu arquivo `.env`, certifique-se de que esteja definido como:

```env
MAIL_MAILER=log

```

*As notificações serão registradas no arquivo `storage/logs/laravel.log`.*

---

## 📝 Documentação da API (Apidog)

Para visualizar a documentação da API utilizando o Apidog:

1. Acesse o [Apidog](https://apidog.com/).
2. Importe o arquivo de definição do projeto (se disponível no repositório) ou crie um projeto novo.
3. Configure a URL base (Base URL) para: `http://127.0.0.1:8000/api`.
4. Todas as rotas estão documentadas conforme os métodos HTTP (GET, POST, etc.) definidos em `routes/api.php`.

---

## ✅ Requisitos Implementados

* [x] **Cadastro de Clientes:** Criação de novos usuários com perfil de cliente.
* [x] **Gestão de Agendamentos:** Registro de horários e serviços.
* [x] **Autenticação:** Proteção de rotas utilizando Laravel Sanctum.
* [x] **Relacionamentos:** Integração entre `User`, `Client` e `Scheduling`.
* [x] **Tratamento de Erros:** Respostas JSON padronizadas para erros de validação e de servidor.

---

## 🧪 Como testar a API (Exemplo com cURL)

Para testar a criação de um cliente via linha de comando ou no **Postman/Insomnia**:

**Rota:** `POST /api/clients`

```bash
curl -X POST http://127.0.0.1:8000/api/clients \
     -H "Authorization: Bearer <SEU_TOKEN_AQUI>" \
     -H "Content-Type: application/json" \
     -H "Accept: application/json" \
     -d '{
           "name": "Nome do Cliente",
           "email": "cliente@email.com",
           "password": "senha123",
           "phone": "12999999999",
           "address": "Rua Exemplo, 123",
           "city": "Cruzeiro"
         }'

```

> **Nota:** Certifique-se de incluir o cabeçalho `Accept: application/json` para receber as respostas da API corretamente em formato JSON.

---

---

*Desenvolvido por Vinicius Gama Bittencourt Lobo.*