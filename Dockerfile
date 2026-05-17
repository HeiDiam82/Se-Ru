# Tahap 1: Build aset frontend dengan Node.js 22 (Wajib untuk Vite 8)
FROM node:22 AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# Tahap 2: Gunakan FrankenPHP (Server PHP Super Cepat & Modern, Anti Error Apache/Nginx)
FROM dunglas/frankenphp:php8.3

# Install ekstensi PostgreSQL untuk Neon DB
RUN install-php-extensions pdo_pgsql pgsql zip

WORKDIR /app

# Copy Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy semua file Laravel
COPY . .

# Copy hasil build Vite dari Tahap 1
COPY --from=frontend /app/public/build ./public/build

# Install dependensi PHP tanpa error interaksi
RUN composer install --optimize-autoloader --no-dev

# Beri hak akses ke folder storage dan cache
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

# Wajib Expose Port 8080 untuk proksi Railway
EXPOSE 8080

# Jalankan migrasi dan nyalakan server FrankenPHP (menggantikan Apache/Nginx yang rewel)
CMD bash -c "php artisan migrate --force && frankenphp php-server -r public/ --listen :8080"
