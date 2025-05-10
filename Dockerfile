# Gunakan image PHP dengan Apache
FROM php:8.2-apache

# Aktifkan mod_rewrite (jika suatu saat pakai .htaccess atau routing URL)
RUN a2enmod rewrite

# Salin semua file project ke folder web Apache
COPY . /var/www/html/

# Ubah permission (opsional, supaya Apache bisa akses file)
RUN chown -R www-data:www-data /var/www/html

# (Opsional) Set working directory
WORKDIR /var/www/html

# (Opsional) Ubah konfigurasi upload size / timezone jika dibutuhkan:
# RUN echo "upload_max_filesize=10M\npost_max_size=10M" > /usr/local/etc/php/conf.d/uploads.ini
