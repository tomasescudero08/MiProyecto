FROM php:8.4-fpm

# 1. Instalar dependencias del sistema, Nginx y gettext-base (necesario para envsubst)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    libpq-dev \
    postgresql-client \
    zip \
    unzip \
    locales \
    nginx \
    gettext-base

# Limpiar caché de paquetes apt
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Instalar extensiones de PHP necesarias para Laravel
RUN docker-php-ext-install pdo_mysql pdo_pgsql pgsql mbstring exif pcntl bcmath gd zip intl opcache

# 3. Copiar ejecutable de Composer desde la imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Establecer directorio de trabajo
WORKDIR /var/www

# 5. Copiar primero únicamente los archivos de dependencias de Composer
COPY composer.json composer.lock ./

# 6. Ejecutar la instalación permitiendo superusuario y omitiendo validaciones estrictas de plataforma
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction --ignore-platform-reqs

# 7. Instalar Node.js y npm para compilar Bootstrap y assets
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs

# 8. Copiar package.json e instalar dependencias de Node
COPY package.json ./
RUN npm install

# 9. Copiar el resto del código del proyecto
COPY . /var/www

# 11. Copiar el template de Nginx a su ubicación de configuración
COPY docker/nginx/conf.d/app.conf.template /etc/nginx/conf.d/app.conf.template

# 12. Asignar permisos correctos a storage y bootstrap/cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# 13. Exponer los puertos necesarios
EXPOSE 9000

# 14. Único CMD al final para limpiar caché, migrar, procesar el puerto de Render y levantar Nginx + PHP-FPM

RUN chown -R www-data:www-data /var/www/public /var/www/storage /var/www/bootstrap/cache

CMD /bin/bash -c "php artisan config:clear && php artisan cache:clear && php artisan view:clear && php artisan migrate --force && envsubst '\$PORT' < /etc/nginx/conf.d/app.conf.template > /etc/nginx/conf.d/app.conf && php-fpm -D && nginx -g 'daemon off;'"
