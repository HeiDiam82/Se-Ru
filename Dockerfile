# Tahap 1: Build aset frontend (Tailwind & Vite) menggunakan Node.js 22
FROM node:22 AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# Tahap 2: Setup PHP CLI (Lebih stabil untuk Railway)
FROM php:8.3-cli

# Install ekstensi yang dibutuhkan Laravel dan PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Pindahkan ke folder kerja utama
WORKDIR /app

# Salin kodingan Laravel
COPY . .

# Salin hasil build Vite dari Tahap 1
COPY --from=frontend /app/public/build ./public/build

# Install dependensi PHP
RUN composer install --optimize-autoloader --no-dev

# Beri hak akses
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

# Jalankan migrasi database otomatis, lalu nyalakan server bawaan Laravel
CMD bash -c "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"
