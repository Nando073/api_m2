FROM php:8.3-cli

WORKDIR /var/www/html

ENV PORT=10000 \
    APP_ENV=production \
    APP_DEBUG=false \
    SESSION_DRIVER=cookie \
    CACHE_STORE=file \
    L5_SWAGGER_GENERATE_ALWAYS=false

RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    libzip-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mysqli \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 1. Copiar archivos esenciales ANTES de instalar dependencias
COPY composer.json composer.lock artisan ./

# 2. Instalar SIN ejecutar scripts automáticos
RUN composer install --optimize-autoloader --no-dev --no-interaction --no-scripts

# 3. Ahora copiar el resto del proyecto
COPY . .

# 4. Ejecutar los scripts manualmente (ahora artisan ya existe)
RUN php artisan package:discover --ansi

# 5. Crear directorios y permisos
RUN mkdir -p storage/logs \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/api-docs \
    bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true

# 6. Asegurar permisos de start.sh
RUN chmod +x /var/www/html/start.sh

EXPOSE 10000

CMD ["/var/www/html/start.sh"]