# XCRM – Sistema de Suporte ao Cliente

**XCRM** é um sistema simples de gerenciamento de suporte desenvolvido em Laravel, com painéis separados para administradores e clientes. Ideal para pequenas empresas ou agências que desejam oferecer atendimento organizado via chamados.

## Funcionalidades

### Painel do Cliente

* Abertura de chamados de suporte
* Listagem e acompanhamento dos chamados enviados

### Painel Administrativo

* Cadastro e gerenciamento de clientes
* Visualização de todos os chamados
* Resposta aos chamados abertos pelos clientes

---

## Tecnologias Utilizadas

* PHP 8.x
* Laravel 12.x
* MySQL
* Blade (Laravel Templating)
* Bootstrap 5

---

## Como Executar o Projeto

### 1. Clone o repositório

```bash
git clone https://github.com/JonathanGibim/xcrm.git
cd xcrm
```

### 2. Instale as dependências

```bash
composer install
```

### 3. Configure o ambiente

Copie o `.env` e configure com suas credenciais de banco:

```bash
cp .env.example .env
```

Edite as seguintes variáveis no `.env`:

```
DB_DATABASE=xcrm
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

### 4. Gere a chave da aplicação

```bash
php artisan key:generate
```

### 5. Execute as migrations

```bash
php artisan migrate
```

### 6. Rode o servidor local

```bash
php artisan serve
```

Acesse em: [http://localhost:8000](http://localhost:8000)

---

## Rotas principais

* `/painel/login` – Login do Cliente
* `/admin/login` – Login do Administrador

---

## Licença

Projeto livre sob licença MIT.

---

## Autor

**Jonathan Gibim**
Agência XWeb
[jonathangibim@gmail.com](mailto:jonathangibim@gmail.com)
