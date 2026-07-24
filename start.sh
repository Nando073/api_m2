#!/bin/bash
set -e

echo "=== Generando documentación Swagger ==="
php artisan l5-swagger:generate

echo "=== Iniciando servidor ==="
php artisan serve --host=0.0.0.0 --port=10000