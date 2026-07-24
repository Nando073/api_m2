#!/bin/bash
set -e
php artisan key:generate --force
php artisan l5-swagger:generate
php artisan serve --host=0.0.0.0 --port="${PORT:-10000}"