# Artisan Tech

Tienda en línea de tecnología hecha con **Laravel 13** y **MySQL**, siguiendo el patrón **MVC**. Proyecto del curso de Arquitectura de Software (EAFIT).

## Despliegue en producción

| | |
|---|---|
| Dominio | http://artisantech.duckdns.org |
| IP (Google Cloud, estática) | http://34.60.117.225 |

Corre en una máquina virtual de Google Cloud con Docker (contenedor de la aplicación + contenedor de MySQL). Solo se sirve por HTTP.

## Funcionalidades

- Catálogo de productos con paginación, detalle y reseñas con calificación.
- Carrito de compras y checkout con dos métodos de pago (tarjeta y contra entrega).
- Panel de administración (solo rol `admin`) con CRUD de productos, categorías y marcas.
- Interfaz en **español e inglés** (selector `ES` / `EN` en el menú).
- Interfaz con **Bootstrap 5** (por CDN): menú que se colapsa en celular y menú de usuario con las iniciales (mis pedidos, panel de administración y cerrar sesión).
- Servicio web JSON propio con el catálogo de productos.
- Consumo de dos servicios externos: el clima de Medellín y la tienda aliada del equipo 1.

## Requisitos

- PHP 8.3 o superior según `composer.json`. **Para producción se usa PHP 8.5.12**, la versión que corrige la vulnerabilidad PHP2Shell.
- Composer
- MySQL (XAMPP, MAMP o el que uses)

Verifica la versión con `php -v`.

## Cómo ejecutarlo en local

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

No hace falta `npm`: Bootstrap se carga por CDN.

## Cómo ejecutarlo con Docker

El `docker-compose.yml` levanta la aplicación (PHP 8.5 + Apache) y MySQL 8.

1. Crear el `.env` a partir de `.env.example` y ajustar al menos:

```env
APP_ENV=production
APP_DEBUG=false
DB_HOST=db
DB_DATABASE=artisantech
DB_USERNAME=root
DB_PASSWORD=<contraseña de root de MySQL>
```

2. Generar la clave de la aplicación y pegarla en `APP_KEY` (por ejemplo con `php artisan key:generate --show`).

3. Construir y levantar los contenedores:

```bash
docker compose up -d --build
```

Al iniciar, el contenedor ejecuta `php artisan migrate --force`.

4. Cargar los datos de prueba (solo la primera vez):

```bash
docker compose exec app php artisan db:seed --force
```

> **Cuidado:** `migrate:fresh` borra toda la base de datos, incluida la caché (el driver de caché es `database`). Eso elimina la última copia guardada de los productos aliados. No lo ejecutes en el servidor una vez cargada la demo.

## Rutas principales

| Ruta | Descripción |
|---|---|
| `/` | Inicio de la tienda (productos más vendidos) |
| `/products`, `/products/{id}` | Catálogo y detalle de producto (con reseñas) |
| `/allied-products` | Productos de la tienda aliada (servicio del equipo 1) |
| `/cart` | Carrito de compras |
| `/checkout` | Confirmar la compra (POST desde el carrito, requiere sesión) |
| `/orders`, `/orders/{id}` | Pedidos del cliente (requiere sesión) |
| `/login`, `/register` | Inicio de sesión y registro |
| `/language/{es\|en}` | Cambio de idioma |
| `/admin` | Resumen del panel de administración (solo rol admin) |
| `/admin/products` | CRUD de productos |
| `/admin/categories` | CRUD de categorías |
| `/admin/brands` | CRUD de marcas |
| `/api/products` | Servicio web JSON propio (ver abajo) |

## Servicio web propio

`GET /api/products` devuelve en JSON los productos activos con stock disponible:

```bash
curl http://artisantech.duckdns.org/api/products
```

```json
[
  {
    "id": 1,
    "name": "iPhone 18 Pro",
    "description": "...",
    "price": "1199.00",
    "stock": 10,
    "brand": "Apple",
    "category": "Celulares",
    "url": "http://artisantech.duckdns.org/products/1"
  }
]
```

Este servicio lo consume el equipo 3.

## Servicios consumidos

| Servicio | Dónde se usa | Clase |
|---|---|---|
| [Open-Meteo](https://open-meteo.com) (clima de Medellín) | Barra superior de todas las páginas | `App\Util\MedellinWeather` |
| Tienda aliada del equipo 1 (`/api/instruments`) | Página `/allied-products` | `App\Util\AlliedStore` |

Ambos servicios fallan de forma controlada, sin mostrar errores al usuario:

- **Clima:** se guarda en caché 10 minutos. Si Open-Meteo no responde, simplemente no se muestra.
- **Tienda aliada:** tiempo máximo de espera de 3 segundos y caché de 60 segundos. Además se guarda una copia "última buena". Si el servicio no responde, se muestra esa copia con un aviso de que puede estar desactualizada; si no hay copia, se muestra un mensaje de servicio no disponible.

La URL del servicio aliado se puede cambiar con la variable `ALLIES_PRODUCTS_URL` en el `.env` (por defecto `http://34.135.31.102/api/instruments`).

## Inversión de dependencias (métodos de pago)

El pedido no depende de un método de pago concreto sino de la interfaz `App\Interfaces\PaymentMethod`:

| Clase | Estado inicial del pedido | Nombre |
|---|---|---|
| `App\Util\CardPayment` | `paid` | `card` |
| `App\Util\CashOnDeliveryPayment` | `pending` | `cash` |

`AppServiceProvider` decide qué implementación entrega el contenedor de Laravel según el campo `payment_method` del formulario de checkout: `cash` entrega `CashOnDeliveryPayment`, cualquier otro valor entrega `CardPayment`. El modelo `Order::placeFromCart()` recibe un `PaymentMethod` sin saber cuál es.

## Usuarios de prueba

Todos usan la contraseña `password`.

| Rol | Correo |
|---|---|
| Administrador | `admin@artisantech.com` |
| Cliente | `laura@artisantech.com` |
| Cliente | `carlos@artisantech.com` |
| Cliente | `ana@artisantech.com` |

Cualquier usuario que se registre queda con rol `customer` y no puede entrar a `/admin`. Los clientes de prueba ya tienen pedidos y reseñas cargados.

## Pruebas

Las pruebas unitarias están en `tests/Unit` (productos, pedidos, ítems de pedido y usuarios):

```bash
php artisan test
```

## Arquitectura

```
Ruta (routes/web.php, routes/api.php) → Controlador → Modelo (Eloquent) → Base de datos
                                              ↓
                                        Vista (Blade)
```

```
app/
├── Http/Controllers/   Controladores (public, Admin/ y Api/)
├── Http/Middleware/    SetLocale (idioma) y EnsureUserIsAdmin
├── Interfaces/         PaymentMethod
├── Models/             User, Product, Category, Brand, Order, OrderItem, Review
└── Util/               CardPayment, CashOnDeliveryPayment, MedellinWeather, AlliedStore

public/css/custom.css   Estilos propios (se cargan después de Bootstrap)
```

### Diagramas

Los diagramas de clases y de arquitectura están en la [wiki del repositorio](https://github.com/IsmaelGC24/ArtisanTech/wiki).

## Seguridad

- La imagen de Docker usa `php:8.5-apache` (PHP 8.5.12), que cubre PHP2Shell.
- El `Dockerfile` desactiva `session.upload_progress` y `fatal_error_backtraces`.
- Las dependencias de producción se instalan con `composer install --no-dev`.
