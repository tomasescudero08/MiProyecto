Credenciales de inisio de sesion como administrador:

correo: admin@hotelpro.com
contraseña: database123


# HotelPro - Sistema de Gestión Hotelera

* **Estudiante:** Tomas Escudero
* **Institución / Contexto:** Proyecto Académico (SENA)

---

## 1. Descripción General de la Aplicación
**HotelPro** es una aplicación web integral para la administración hotelera desarrollada con Laravel. Permite gestionar de manera eficiente las reservas de habitaciones, catálogos de servicios, moderación de reseñas, consultas de contacto y el flujo completo de autenticación de usuarios (con roles diferenciados para administradores y huéspedes). Además, incluye un robusto sistema de recuperación de contraseñas y estricto cumplimiento normativo en protección de datos personales.

---

## 2. Tecnologías y Servicios Utilizados
* **Backend:** PHP 8.x con el framework **Laravel**.
* **Frontend:** Bootstrap 5, Bootstrap Icons, HTML5, CSS3 y JavaScript.
* **Base de Datos:** MySQL / MariaDB (gestionada mediante migraciones y ORM Eloquent).
* **Entorno de Desarrollo Local:** WampServer / XAMPP con Visual Studio Code y PyCharm.

---

## 3. Estructura de la Base de Datos y Relaciones
La base de datos cuenta con las siguientes entidades principales y relaciones clave:
* **Users (Usuarios):** Almacena la información de los usuarios registrados, credenciales de acceso, roles (`is_admin`) y soporte para eliminación suave (`SoftDeletes`).
* **Rooms (Habitaciones):** Contiene el inventario de suites y habitaciones disponibles en el catálogo.
* **Services (Servicios):** Catálogo de amenidades y servicios adicionales ofrecidos por el hotel.
* **Reservations (Reservas):** Relaciona a los usuarios (`user_id`) con las habitaciones (`room_id`), registrando fechas de estancia, estado y detalles de la reserva.
* **Reviews (Reseñas) & Contact Messages (Mensajes):** Tablas de interacción orientadas a la moderación de opiniones de huéspedes y gestión de la bandeja de entrada corporativa.

---

## 4. Instrucciones para Ejecutar el Proyecto Localmente
Sigue estos pasos para clonar y poner en marcha el proyecto en tu entorno local:

1. Clona el repositorio en tu servidor local (ej. directorio `htdocs` o `www`):
   ```bash
   git clone <https://github.com/tomasescudero08/MiProyecto>
   
## Instrucciones para instalar

1. Instala las dependencias del proyecto mediante Composer:

composer install

2. Copia el archivo de configuración de entorno:

cp .env.example .env

3. Genera la llave de la aplicación:

php artisan key:generate

4. Configura los parámetros de tu base de datos en el archivo .env.

5. Ejecuta las migraciones de la base de datos:

php artisan migrate

6. Inicia el servidor de desarrollo local:

php artisan serve 

7. Variables de Entorno Necesarias


APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:nCe7DtdsNMru57e4aQo5G6PzJLjg2Y+VL4juK9/rcpQ=
APP_DEBUG=false
APP_URL=http://localhost:8000

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

# PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=MiProyecto
# DB_USERNAME=root
# DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
QUEUE_CONNECTION=sync

CACHE_STORE=database
# CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=resend
MAIL_USERNAME=resend
MAIL_PASSWORD=re_WjexsdBU_7maes9z9G1aCjuXcHE8CnPGT
MAIL_FROM_ADDRESS=onboarding@resend.dev
MAIL_FROM_NAME="hotelpro"
MAIL_HERO_IMAGE=https://images.unsplash.com/photo-1618773928121-c32242e63f39

RESEND_API_KEY=re_WjexsdBU_7maes9z9G1aCjuXcHE8CnPGT

FILESYSTEM_DISK=s3

AWS_ACCESS_KEY_ID=0057f9d9fcbac380000000001
AWS_SECRET_ACCESS_KEY=K005gWsNnZBoRNvGzEZpMR07YvIj2Xk
AWS_DEFAULT_REGION=us-east-005
AWS_BUCKET=miproyecto-storage
AWS_ENDPOINT=https://s3.us-east-005.backblazeb2.com
AWS_USE_PATH_STYLE_ENDPOINT=true

VITE_APP_NAME="${APP_NAME}"
SENTRY_LARAVEL_DSN=https://ac103f66c3e31e0c14bc63f4ebfe8653@o4512370815664128.ingest.us.sentry.io/4512382019764224
SENTRY_SEND_DEFAULT_PII=true
SENTRY_TRACES_SAMPLE_RATE=1.0
SENTRY_RELEASE=miproyecto@1.0.0
SENTRY_SAMPLE_RATE=1.0

6. Descripción de Integraciones Clave
   
- Resend: Utilizado como proveedor de servicios de correo electrónico transaccional mediante su API HTTP segura (puerto 443), permitiendo el envío eficiente de notificaciones corporativas y de recuperación de contraseña con plantillas HTML personalizadas.
- Better Stack: (Integración prevista/configurada) Plataforma orientada al monitoreo de tiempo actividad (uptime) y gestión centralizada de logs del sistema.
- Backblaze B2: (Integración prevista/configurada) Almacenamiento en la nube escalable y de bajo costo para la gestión de archivos multimedia e imágenes de las habitaciones.
- Sentry: (Integración prevista/configurada) Sistema de monitoreo de errores en tiempo real y seguimiento de excepciones para entornos de producción.

7. Privacidad y Tratamiento de Datos (Ley 1581 de 2012)
   
HotelPro incorpora los mecanismos necesarios para garantizar la privacidad y el ejercicio de los derechos de los usuarios bajo la normativa colombiana:

- Política de Tratamiento de Datos: Accesible públicamente desde la plataforma, informando de manera clara la finalidad de la recolección y los datos del responsable.
- Autorización Explícita: Mecanismo de aceptación obligatoria de términos y políticas en el registro de usuarios.
- Gestión de Cuentas y Supresión: Opción visible en el perfil del usuario para solicitar la eliminación de su cuenta protegida mediante verificación de contraseña actual.
- Conservación Legal y Anonimización: Implementación de borrado suave (SoftDeletes) y anonimización de datos sensibles de identificación (nombre y correo), asegurando que los registros históricos obligatorios (como reservas y contabilidad) se conserven conforme a los mandatos legales sin vulnerar la privacidad del usuario.
