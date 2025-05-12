FROM php:7.4-apache

# Install ekstensi mysqli dan PDO MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Aktifkan mod_rewrite untuk .htaccess
RUN a2enmod rewrite

# Copy semua file project
COPY . /var/www/html/

# Ubah permission (opsional)
RUN chown -R www-data:www-data /var/www/html
