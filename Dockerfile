# Gunakan image PHP 8.2 dengan Apache
FROM php:8.2-apache

# Aktifkan mod_rewrite untuk .htaccess jika diperlukan
RUN a2enmod rewrite

# Install ekstensi mysqli untuk koneksi database MySQL
RUN docker-php-ext-install mysqli

# Salin seluruh project ke folder kerja di dalam container
COPY . /var/www/html/

# Ubah hak akses agar bisa diakses Apache
RUN chown -R www-data:www-data /var/www/html

# Set direktori kerja
WORKDIR /var/www/html
