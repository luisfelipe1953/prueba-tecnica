## El archivo json de postman esta en la raiz del proyecto

## Instalación, Configuración y Uso

### Instalación

1. Ejecuta el comando `composer install` para instalar las dependencias de Composer.
2. Ejecuta el comando `npm install` para instalar las dependencias de npm.

### Configuración de archivo .env

1. Copia el archivo de ejemplo `.env.example` y renómbralo como `.env`.
2. Configura las variables de entorno en el archivo `.env` según tus necesidades.

### Ejecutar migraciones con datos falsos

1. Ejecuta el comando `php artisan migrate --seed` para ejecutar las migraciones con datos falsos.

### Iniciar el servidor

1. Ejecuta el comando `php artisan serve` para iniciar el servidor. Luego, abre el navegador y visita `http://localhost` para acceder al módulo de creación, edición, etc., de usuarios.
2. Ejecuta el comando `npm run dev` para compilar los assets.

### Ejecutar pruebas unitarias y funcionales

Antes de ejecutar las pruebas, asegúrate de tener la extensión SQLite habilitada en tu archivo `php.ini`.

1. Ejecuta el comando `php artisan config:clear`.
2. Ejecuta el comando `php artisan test` para ejecutar las pruebas.

## Instrucciones de las APIs

Aquí se detallan las instrucciones para utilizar las APIs:

- `GET http://127.0.0.1:8000/api/api-users`: Obtiene una lista paginada de usuarios.
- `GET http://127.0.0.1:8000/api/api-users?page=2`: Obtiene la segunda página de usuarios paginados y así sucesivamente.
- `POST http://127.0.0.1:8000/api/api-users`: Añade un nuevo usuario. Los parámetros deben ser proporcionados en el cuerpo de la solicitud.
- `PUT http://127.0.0.1:8000/api/api-users/1`: Actualiza un usuario existente con ID 1. Los parámetros deben ser proporcionados en el cuerpo de la solicitud.
- `GET http://127.0.0.1:8000/api/api-users/1`: Obtiene los detalles del usuario con ID 1.
- `DELETE http://127.0.0.1:8000/api/api-users/1`: Elimina el usuario con ID 1.