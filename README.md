# Gestión de Productos

Prueba técnica desarrollada utilizando **Laravel 12** para la API REST y **Vue 3** para la interfaz de usuario.

## Tecnologías utilizadas

* PHP 8.2+
* Laravel 12
* Vue 3
* MySQL
* Node.js
* NPM

---

## Requisitos previos

Antes de ejecutar el proyecto, asegúrate de tener instalado:

* PHP 8.2 o superior
* Composer
* Node.js
* NPM
* MySQL

---

## Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/sergioxd343/Productos.git
cd productos
```

### 2. Instalar dependencias

#### Backend

```bash
composer install
```

#### Frontend

```bash
npm install
```

### 3. Configurar variables de entorno

Copiar el archivo `.env.example`:



```bash
cp .env.example .env
```

Configurar las credenciales de conexión a la base de datos dentro del archivo `.env`.

Generar la clave de la aplicación:

### 4. Ejecutar migraciones

```bash
php artisan migrate
```

Si deseas recrear la base de datos y cargar información de prueba:

```bash
php artisan migrate:refresh --seed
```

---

## Ejecución del proyecto

### Iniciar 

```bash
npm run dev
```

---

# API REST


## Endpoints disponibles

### Obtener todos los productos

**GET** `/api/productos`

```bash
curl --location 'http://localhost:8000/api/productos' \
--header 'Accept: application/json' \
--header 'Cookie: XSRF-TOKEN=eyJpdiI6InBNQjdmdDBqQnFrN1FoaGNtSW1LTUE9PSIsInZhbHVlIjoiUE9NLzk0bWFmQ2oySVlqempXdWN3STBiaEZVTkhkNE9iRFo5RlhVdEhJcXROcGVTY3B2TTZuQXI0dWROUFYvL3Y4NzNvbk5TbVhtNlNWbWVtVWlCTlA1YTFVc2drMmpYM0E3cXJXWEhLRnVRQ0duWWhkTFVLQTJHTkV0YmJpUVoiLCJtYWMiOiI3YWU1MWNiYzRiMzUyNzg1NDMxMmZlNDdlN2JjMzFlNzNkYTYwMjc5MTA0ODI2MjkzMTgzODg3NTQ5ZjIwYzVlIiwidGFnIjoiIn0%3D; pirma_session=eyJpdiI6Ik5QRk9LdGdUUjVWamt4cE5aeGVJOWc9PSIsInZhbHVlIjoidnFNV3hEdCtBQis4a1JrS1BVdXlDN1pZWExmQ1RMNFJSbFdNeElIQit2UU1LU2FraFQ3NlN4YWFIUE8vV2ZtZmgxd3Q0andaems1Y1ZpNlJQOGRadnFCQ1lqc0hFMEhCWnJrZXhNL29KbmRWMmZ1RDFLZU1CZkV1M3lnUWtCOGEiLCJtYWMiOiIyMzJmM2ZmMGFjMWFmM2Y0NTk0OWMxMzU3MmQ4NWNmNzljZmRmZjRmNGMyNzM0ODA5YTJhZDdlMzJjOGZjNGIwIiwidGFnIjoiIn0%3D'
```

---

### Obtener producto por ID

**GET** `/api/productos/{id}`

```bash
curl --location 'http://localhost:8000/api/productos/2' \
--header 'Accept: application/json' \
--header 'Cookie: XSRF-TOKEN=eyJpdiI6InBNQjdmdDBqQnFrN1FoaGNtSW1LTUE9PSIsInZhbHVlIjoiUE9NLzk0bWFmQ2oySVlqempXdWN3STBiaEZVTkhkNE9iRFo5RlhVdEhJcXROcGVTY3B2TTZuQXI0dWROUFYvL3Y4NzNvbk5TbVhtNlNWbWVtVWlCTlA1YTFVc2drMmpYM0E3cXJXWEhLRnVRQ0duWWhkTFVLQTJHTkV0YmJpUVoiLCJtYWMiOiI3YWU1MWNiYzRiMzUyNzg1NDMxMmZlNDdlN2JjMzFlNzNkYTYwMjc5MTA0ODI2MjkzMTgzODg3NTQ5ZjIwYzVlIiwidGFnIjoiIn0%3D; pirma_session=eyJpdiI6Ik5QRk9LdGdUUjVWamt4cE5aeGVJOWc9PSIsInZhbHVlIjoidnFNV3hEdCtBQis4a1JrS1BVdXlDN1pZWExmQ1RMNFJSbFdNeElIQit2UU1LU2FraFQ3NlN4YWFIUE8vV2ZtZmgxd3Q0andaems1Y1ZpNlJQOGRadnFCQ1lqc0hFMEhCWnJrZXhNL29KbmRWMmZ1RDFLZU1CZkV1M3lnUWtCOGEiLCJtYWMiOiIyMzJmM2ZmMGFjMWFmM2Y0NTk0OWMxMzU3MmQ4NWNmNzljZmRmZjRmNGMyNzM0ODA5YTJhZDdlMzJjOGZjNGIwIiwidGFnIjoiIn0%3D'
```

---

### Crear producto

**POST** `/api/productos`

```bash
curl --location 'http://localhost:8000/api/productos' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer 1|LgzeIA638zVT44eOOfLFDNbQsja4WR4Nw5wnlbkj3ea61c47' \
--form 'nombre="Laptop Dell XPS"' \
--form 'categoria="Hogar"' \
--form 'precio_unitario="22500.00"' \
--form 'stock="15"'
```


### Actualizar producto

**PUT** `/api/productos/{id}`

```bash
curl --location --request PUT 'http://localhost:8000/api/productos/1' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--header 'Cookie: XSRF-TOKEN=eyJpdiI6InBNQjdmdDBqQnFrN1FoaGNtSW1LTUE9PSIsInZhbHVlIjoiUE9NLzk0bWFmQ2oySVlqempXdWN3STBiaEZVTkhkNE9iRFo5RlhVdEhJcXROcGVTY3B2TTZuQXI0dWROUFYvL3Y4NzNvbk5TbVhtNlNWbWVtVWlCTlA1YTFVc2drMmpYM0E3cXJXWEhLRnVRQ0duWWhkTFVLQTJHTkV0YmJpUVoiLCJtYWMiOiI3YWU1MWNiYzRiMzUyNzg1NDMxMmZlNDdlN2JjMzFlNzNkYTYwMjc5MTA0ODI2MjkzMTgzODg3NTQ5ZjIwYzVlIiwidGFnIjoiIn0%3D; pirma_session=eyJpdiI6Ik5QRk9LdGdUUjVWamt4cE5aeGVJOWc9PSIsInZhbHVlIjoidnFNV3hEdCtBQis4a1JrS1BVdXlDN1pZWExmQ1RMNFJSbFdNeElIQit2UU1LU2FraFQ3NlN4YWFIUE8vV2ZtZmgxd3Q0andaems1Y1ZpNlJQOGRadnFCQ1lqc0hFMEhCWnJrZXhNL29KbmRWMmZ1RDFLZU1CZkV1M3lnUWtCOGEiLCJtYWMiOiIyMzJmM2ZmMGFjMWFmM2Y0NTk0OWMxMzU3MmQ4NWNmNzljZmRmZjRmNGMyNzM0ODA5YTJhZDdlMzJjOGZjNGIwIiwidGFnIjoiIn0%3D' \
--data '{
    "nombre": "Laptop Dell",
    "categoria": "Electrónica",
    "precio_unitario": 15000,
    "stock": 10
}'
```

---

### Eliminar producto

**DELETE** `/api/productos/{id}`

```bash
curl --location --request DELETE 'http://localhost:8000/api/productos/5' \
--header 'Accept: application/json' \
--header 'Cookie: XSRF-TOKEN=eyJpdiI6InBNQjdmdDBqQnFrN1FoaGNtSW1LTUE9PSIsInZhbHVlIjoiUE9NLzk0bWFmQ2oySVlqempXdWN3STBiaEZVTkhkNE9iRFo5RlhVdEhJcXROcGVTY3B2TTZuQXI0dWROUFYvL3Y4NzNvbk5TbVhtNlNWbWVtVWlCTlA1YTFVc2drMmpYM0E3cXJXWEhLRnVRQ0duWWhkTFVLQTJHTkV0YmJpUVoiLCJtYWMiOiI3YWU1MWNiYzRiMzUyNzg1NDMxMmZlNDdlN2JjMzFlNzNkYTYwMjc5MTA0ODI2MjkzMTgzODg3NTQ5ZjIwYzVlIiwidGFnIjoiIn0%3D; pirma_session=eyJpdiI6Ik5QRk9LdGdUUjVWamt4cE5aeGVJOWc9PSIsInZhbHVlIjoidnFNV3hEdCtBQis4a1JrS1BVdXlDN1pZWExmQ1RMNFJSbFdNeElIQit2UU1LU2FraFQ3NlN4YWFIUE8vV2ZtZmgxd3Q0andaems1Y1ZpNlJQOGRadnFCQ1lqc0hFMEhCWnJrZXhNL29KbmRWMmZ1RDFLZU1CZkV1M3lnUWtCOGEiLCJtYWMiOiIyMzJmM2ZmMGFjMWFmM2Y0NTk0OWMxMzU3MmQ4NWNmNzljZmRmZjRmNGMyNzM0ODA5YTJhZDdlMzJjOGZjNGIwIiwidGFnIjoiIn0%3D'
```

---

## Filtros

### Filtrar por categoría

**GET** `/api/productos/categoria/{categoria}`

```bash
curl --location 'http://localhost:8000/api/productos/categoria/Hogar' \
--header 'Accept: application/json' \
--header 'Cookie: XSRF-TOKEN=eyJpdiI6InBNQjdmdDBqQnFrN1FoaGNtSW1LTUE9PSIsInZhbHVlIjoiUE9NLzk0bWFmQ2oySVlqempXdWN3STBiaEZVTkhkNE9iRFo5RlhVdEhJcXROcGVTY3B2TTZuQXI0dWROUFYvL3Y4NzNvbk5TbVhtNlNWbWVtVWlCTlA1YTFVc2drMmpYM0E3cXJXWEhLRnVRQ0duWWhkTFVLQTJHTkV0YmJpUVoiLCJtYWMiOiI3YWU1MWNiYzRiMzUyNzg1NDMxMmZlNDdlN2JjMzFlNzNkYTYwMjc5MTA0ODI2MjkzMTgzODg3NTQ5ZjIwYzVlIiwidGFnIjoiIn0%3D; pirma_session=eyJpdiI6Ik5QRk9LdGdUUjVWamt4cE5aeGVJOWc9PSIsInZhbHVlIjoidnFNV3hEdCtBQis4a1JrS1BVdXlDN1pZWExmQ1RMNFJSbFdNeElIQit2UU1LU2FraFQ3NlN4YWFIUE8vV2ZtZmgxd3Q0andaems1Y1ZpNlJQOGRadnFCQ1lqc0hFMEhCWnJrZXhNL29KbmRWMmZ1RDFLZU1CZkV1M3lnUWtCOGEiLCJtYWMiOiIyMzJmM2ZmMGFjMWFmM2Y0NTk0OWMxMzU3MmQ4NWNmNzljZmRmZjRmNGMyNzM0ODA5YTJhZDdlMzJjOGZjNGIwIiwidGFnIjoiIn0%3D'
```

---

### Paginación

**GET** `/api/productos/pagina/{pagina}/size/{size}`

```bash
curl --location 'http://localhost:8000/api/productos/pagina/1/size/10' \
--header 'Accept: application/json' \
--header 'Cookie: XSRF-TOKEN=eyJpdiI6InBNQjdmdDBqQnFrN1FoaGNtSW1LTUE9PSIsInZhbHVlIjoiUE9NLzk0bWFmQ2oySVlqempXdWN3STBiaEZVTkhkNE9iRFo5RlhVdEhJcXROcGVTY3B2TTZuQXI0dWROUFYvL3Y4NzNvbk5TbVhtNlNWbWVtVWlCTlA1YTFVc2drMmpYM0E3cXJXWEhLRnVRQ0duWWhkTFVLQTJHTkV0YmJpUVoiLCJtYWMiOiI3YWU1MWNiYzRiMzUyNzg1NDMxMmZlNDdlN2JjMzFlNzNkYTYwMjc5MTA0ODI2MjkzMTgzODg3NTQ5ZjIwYzVlIiwidGFnIjoiIn0%3D; pirma_session=eyJpdiI6Ik5QRk9LdGdUUjVWamt4cE5aeGVJOWc9PSIsInZhbHVlIjoidnFNV3hEdCtBQis4a1JrS1BVdXlDN1pZWExmQ1RMNFJSbFdNeElIQit2UU1LU2FraFQ3NlN4YWFIUE8vV2ZtZmgxd3Q0andaems1Y1ZpNlJQOGRadnFCQ1lqc0hFMEhCWnJrZXhNL29KbmRWMmZ1RDFLZU1CZkV1M3lnUWtCOGEiLCJtYWMiOiIyMzJmM2ZmMGFjMWFmM2Y0NTk0OWMxMzU3MmQ4NWNmNzljZmRmZjRmNGMyNzM0ODA5YTJhZDdlMzJjOGZjNGIwIiwidGFnIjoiIn0%3D'
```

## Estructura de la solución

### Backend

* Laravel 12
* API RESTful
* Validaciones mediante Request Validation
* Migraciones y Seeders
* Eloquent ORM


## Decisiones técnicas

* Se utilizó `Route::apiResource()` para exponer los endpoints CRUD de manera estandarizada.
* Se implementaron migraciones para mantener versionada la estructura de la base de datos.
* Se utilizaron seeders para generar información inicial de prueba.
* Se agregaron filtros por categoría y paginación para optimizar las consultas.
* Se implementó una arquitectura separada entre frontend y backend para facilitar la escalabilidad y mantenimiento del proyecto.

---

## Autor 
Sergio Hernandez Tavares

Prueba técnica CRUD de Productos desarrollada con Laravel 12 y Vue 3.
