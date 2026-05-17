#!/bin/sh
set -e

# Railway memberi PORT secara dinamis, fallback ke 8080 kalau tidak ada
export PORT=${PORT:-8080}

echo "Starting with PORT=$PORT"

# Substitusi ${PORT} di nginx config menggunakan nilai asli dari environment Railway
envsubst '${PORT}' < /etc/nginx/http.d/default.conf.template > /etc/nginx/http.d/default.conf

# Jalankan migrasi database
php /var/www/html/artisan migrate --force

# Jalankan supervisord (manages both php-fpm & nginx)
exec /usr/bin/supervisord -c /etc/supervisord.conf
