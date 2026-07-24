#!/bin/bash
set -e

echo "=== Configurando entorno ==="

if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "" ]; then
    echo ">>> Generando APP_KEY..."
    php artisan key:generate --force
fi

echo "=== Limpiando caches antiguos ==="
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true
php artisan cache:clear || true

echo "=== Ejecutando migraciones ==="
php artisan migrate --force || true

echo "=== Generando documentación Swagger ==="
php artisan l5-swagger:generate || true

echo "=== Optimizando para producción ==="
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo "=== Iniciando servidor en 0.0.0.0:$PORT ==="
php artisan serve --host=0.0.0.0 --port="${PORT:-10000}"
