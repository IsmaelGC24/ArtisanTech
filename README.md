# Artisan Tech

Tienda en línea de tecnología hecha con Laravel 13 y MySQL, siguiendo el patrón MVC. Proyecto del curso de Arquitectura de Software (EAFIT).

## Requisitos

- PHP 8.4 o superior (verifica con `php -v`)
- Composer
- MySQL (con XAMPP, MAMP o el que uses)

## Cómo ejecutarlo

1. Clonar el repositorio e instalar dependencias:

```bash
   git clone https://github.com/IsmaelGC24/ArtisanTech.git
   cd ArtisanTech
   composer install
```

2. Crear el archivo de configuración y la clave de la aplicación:

```bash
   copy .env.example .env
   php artisan key:generate
```

3. Crear una base de datos MySQL vacía llamada `artisantech` y ajustar en `.env` el usuario, la contraseña y el puerto (`DB_USERNAME`, `DB_PASSWORD`, `DB_PORT`) si son distintos.

4. Crear las tablas y cargar los datos de prueba:

```bash
   php artisan migrate:fresh --seed
```

5. Levantar el servidor:

```bash
   php artisan serve
```

No hace falta `npm`: Bootstrap y Tailwind se cargan por CDN.

## Rutas principales

| Ruta | Descripción |
|---|---|
| `/` | Página de inicio de la tienda |
| `/login`, `/register` | Inicio de sesión y registro |
| `/admin` | Resumen del panel de administración (solo rol admin) |
| `/admin/products` | CRUD de productos |
| `/admin/categories` | CRUD de categorías |

## Usuario administrador de prueba

| Campo | Valor |
|---|---|
| Correo | `admin@artisantech.com` |
| Contraseña | `password` |

Cualquier usuario que se registre queda con rol `customer` y no puede entrar a `/admin`.

## Arquitectura

```
Ruta (routes/web.php) → Controlador → Modelo (Eloquent) → Base de datos
                              ↓
                        Vista (Blade)
```