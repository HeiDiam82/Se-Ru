# Tahap 1: Build aset frontend (Tailwind & Vite) menggunakan Node.js 22
FROM node:22 AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# Tahap 2: Setup PHP, Apache, dan backend Laravel
FROM php:8.3-apache

# Install ekstensi yang dibutuhkan Laravel dan PostgreSQL (Neon DB)
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql

# Ubah settingan Apache agar membaca folder public/ Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Pindahkan ke folder kerja utama
WORKDIR /var/www/html

# Salin kodingan Laravel
COPY . .

# Salin hasil build Vite dari Tahap 1
COPY --from=frontend /app/public/build ./public/build

# Install dependensi PHP (Vendor)
RUN composer install --optimize-autoloader --no-dev

# Beri hak akses agar Laravel bisa menyimpan cache dan log
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Buka port 80 (Port bawaan web)
EXPOSE 80

# Saat aplikasi jalan, lakukan migrate otomatis lalu nyalakan Apache
CMD bash -c "php artisan migrate --force && apache2-foreground"
