
# Homing API

Homing es una API RESTful desarrollada con Laravel, que sirve como backend de una plataforma para la adopción de animales domésticos. Está diseñada para gestionar usuarios, refugios, criadores, animales, imágenes, solicitudes de adopción, y más. La API facilita la conexión entre adoptantes potenciales y entidades responsables de animales como shelters (refugios) y breeders (criadores), permitiendo un flujo de trabajo organizado y controlado para las solicitudes de adopción.

---

## Características principales

- Autenticación segura con **Laravel Sanctum**.
- CRUD completo para **usuarios**, **criadores**, **refugios**, **animales**, **solicitudes de adopción** y entidades auxiliares.
- Asociación de animales con imágenes, categorías, géneros, estados y otras propiedades filtrables.
- Sistema de **favoritos** para que los usuarios puedan guardar animales de interés.
- Gestión de estados de adopción mediante la tabla `housing_stages`.
- Validaciones centralizadas y control de errores.
- Estructura clara y escalable con **migraciones**, **seeders**, **modelos**, **rutas** y **controladores** separados.

---

## Modelo de datos

<img src="/resources/assets/modelo-datos-homing.png"></img>

---

## Tablas principales

- `users` – Gestión de usuarios y roles.
- `roles` – Información de los roles.
- `shelters` – Información de los refugios.
- `breeders` – Información de los criadores.
- `animals` – Registro de animales con detalles.
- `animal_images` – Imágenes asociadas a animales.
- `applications` – Solicitudes de adopción.
- `favorites` – Relación entre usuarios y animales favoritos.
- Tablas auxiliares: `housing_stages`, `species`, `status`, `agecategories`, `genres`, `sizes`, `energy_levels`.

---

## Requisitos previos

- PHP >= 8.2
- Composer
- Laravel >= 10
- PostgreSQL
- Base de datos llamada `homing` creada manualmente con una contraseña establecida en `.env`

---

## Preparación del entorno

### 1. Clonar el repositorio

```bash
git clone https://github.com/tu_usuario/homing-api.git
cd homing-api
```

### 2. Instalar dependencias

```bash
composer install
```

### 3. Configurar el entorno

Copia el archivo `.env.example` y renómbralo como `.env`. Luego configura la conexión a tu base de datos PostgreSQL:

```bash
cp .env.example .env
```

Modifica las siguientes variables en `.env`:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=homing
DB_USERNAME=postgres
DB_PASSWORD=tu_contraseña
```

### 4. Generar la clave de la aplicación

```bash
php artisan key:generate
```

---

## Migraciones y Seeders

Para crear las tablas y poblarlas con datos iniciales en las tablas auxiliares:

### 5. Ejecutar migraciones

Es recomendable hacer la migración de la tabla de roles ya que la tabla user tiene relación con la de roles.

```bash
php artisan migrate
```

### 6. Ejecutar seeders

```bash
php artisan db:seed 
```

O, si quieres reiniciar solo un tabla concreta:

```bash
php artisan db:seed --class=NombreSeeder
```

---

## Arranque del proyecto

```bash
php artisan serve
```

La API estará disponible en `http://127.0.0.1:8000/api`

---

## Colección de Postman

### Collection

```bash

https://postman.co/workspace/My-Workspace~9d7bd3e3-9450-4b3f-86c1-fcb15071828e/collection/31110220-5c524b3d-a7b5-46dc-854d-77c12c4fd7fd?action=share&creator=31110220&active-environment=31110220-48476310-96cf-44f7-90b1-9cee770f80d3
```

---

### Environment

```bash

https://postman.co/workspace/My-Workspace~9d7bd3e3-9450-4b3f-86c1-fcb15071828e/environment/31110220-48476310-96cf-44f7-90b1-9cee770f80d3?action=share&creator=31110220&active-environment=31110220-48476310-96cf-44f7-90b1-9cee770f80d3
```

---

## Estructura principal del proyecto

```bash
app/
├── Http/
│   ├── Controllers/
│   └── Requests/
├── Models/
database/
├── migrations/
├── seeders/
routes/
├── api.php
.env
```

---

## Autoria

Proyecto propiedad de **Omar Hevia Arbana**  y realizado como parte del **Trabajo Final del Master Universitario de Desarrollo de Aplicaciones y sitios web de la Universitat Oberta de Catalunya**.

---

## Contacto

Para cualquier duda o sugerencia, puedes escribir a `ohevia@uoc.edu`

---

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
