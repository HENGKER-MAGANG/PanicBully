# Menggunakan image resmi PHP dengan Apache
FROM php:8.2-apache

# Install ekstensi MySQL untuk PHP
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Salin semua file project ke dalam container
COPY . /var/www/html/

# Ubah kepemilikan agar bisa diakses web server
RUN chown -R www-data:www-data /var/www/html

# Aktifkan mod_rewrite
RUN a2enmod rewrite
