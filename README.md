# Laravel Authenticatie – Ninja Network

A Laravel web application with user registration, login and logout, built week by week as a school project. Logged-in users can manage a list of ninjas that belong to dojos.

## Features

- Register, log in and log out (session-based authentication)
- Routes protected with `auth` and `guest` middleware
- View all ninjas, view one ninja, create a ninja and delete a ninja
- Ninjas linked to dojos with Eloquent relationships
- Form validation with error messages
- Styled login and register pages with Tailwind CSS

## Built with

- PHP 8.2
- Laravel 12
- Blade templates
- Tailwind CSS 4
- Vite

## Getting started

```bash
git clone https://github.com/2159863-sys/laravel-authenticatie.git
cd laravel-authenticatie
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run build
php artisan serve
```

Then open http://localhost:8000 and register an account.

## Project structure

| Path | What it contains |
|------|------------------|
| `routes/web.php` | Auth routes and ninja routes |
| `app/Http/Controllers/AuthController.php` | Register, login and logout |
| `app/Http/Controllers/NinjaController.php` | List, show, create and delete ninjas |
| `app/Models` | `User`, `Ninja` and `Dojo` models |
| `resources/views` | Blade views for auth and ninjas |
