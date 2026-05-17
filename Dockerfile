# Stage 1: Build frontend assets
FROM node:22-alpine AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# Stage 2: PHP-FPM + Nginx (Industry Standard Laravel Production)
FROM php:8.3-fpm-alpine

# Install Nginx, Supervisor, dan ekstensi PostgreSQL
RUN apk add --no-cache nginx supervisor postgresql-dev libpq \
    && docker-php-ext-install pdo pdo_pgsql opcache

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy semua file Laravel
COPY . .
COPY --from=frontend /app/public/build ./public/build

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev --no-interaction

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Copy konfigurasi Nginx dan Supervisord
COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/supervisord.conf /etc/supervisord.conf

# Buat folder run untuk nginx
RUN mkdir -p /run/nginx

# Jalankan migrasi lalu start php-fpm dan nginx langsung (tanpa file entrypoint terpisah)
CMD sh -c "php /var/www/html/artisan migrate --force && php-fpm -D && nginx -g 'daemon off;'"
