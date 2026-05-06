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

| Method | Endpoint        | Description                           |
| ------ | --------------- | ------------------------------------- |
| GET    | `/api/users`    | List all users                        |
| GET    | `/api/users/{id}` | Get a specific user by ID (with related invoices) |
| GET    | `/api/invoices` | List all invoices (with related user) |

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
