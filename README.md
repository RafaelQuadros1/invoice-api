# API Laravel

## About

REST API built with **Laravel 13** and **PHP 8.3**, designed to manage users and their invoices. The project follows a versioned structure (`api/v1`).

---

### Stack

- Laravel 13
- PHP 8.3
- Laravel Sanctum
- Laragon (local environment)

---

## Current State

The API currently exposes two public endpoints:

| Method | Endpoint                | Description                                       |
| ------ | ----------------------- | ------------------------------------------------- |
| GET    | `/api/v1/users`         | List all users                                    |
| GET    | `/api/v1/users/{id}`    | Get a specific user by ID (with related invoices) |
| POST   | `/api/v1/users`         | Create a new user                                 |
| GET    | `/api/v1/invoices`      | List all invoices (with related user)             |
| GET    | `/api/v1/invoices/{id}` | Get a specific invoice by ID (with related user)  |
| POST   | `/api/v1/invoices`      | Create a new invoice                              |
| PUT    | `/api/v1/invoices/{id}` | Update an existing invoice                        |
| DELETE | `/api/v1/invoices/{id}` | Delete an invoice                                 |

---

## Filtering Invoices

O endpoint `GET /api/v1/invoices` aceita filtros via query string no formato `param[operador]=valor`.

### Parâmetros disponíveis

| Parâmetro      | Coluna no banco | Operadores aceitos                   |
| -------------- | --------------- | ------------------------------------ |
| `value`        | `amount`        | `gt`, `lt`, `eq`, `ne`, `gte`, `lte` |
| `type`         | `type`          | `eq`, `ne`, `in`                     |
| `paid`         | `is_paid`       | `eq`, `ne`                           |
| `payment_date` | `payment_date`  | `gt`, `lt`, `eq`, `ne`, `gte`, `lte` |

### Operadores

| Operador | SQL  |
| -------- | ---- |
| `eq`     | `=`  |
| `ne`     | `!=` |
| `gt`     | `>`  |
| `lt`     | `<`  |
| `gte`    | `>=` |
| `lte`    | `<=` |
| `in`     | `IN` |

### Exemplos

```
GET /api/invoices?value[gt]=100
GET /api/invoices?value[gte]=50&value[lte]=500
GET /api/invoices?paid[eq]=1
GET /api/invoices?type[in]=C,P
GET /api/invoices?type[eq]=B&paid[eq]=0
GET /api/invoices?payment_date[gt]=2024-01-01&payment_date[lt]=2024-12-31
```

> Para `type[in]`, separe os valores por vírgula: `type[in]=C,B,P`

---

## Simple Future

Planned next steps for the project:

- [ ] colocar swagger api

---

## Getting Started

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```
