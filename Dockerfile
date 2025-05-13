FROM php:8.2-apache

# Install mysqli
RUN docker-php-ext-install mysqli

# Copy kode kamu
COPY . /var/www/html/

# Tambahkan wait script (opsional)
COPY wait-for-it.sh /wait-for-it.sh
RUN chmod +x /wait-for-it.sh

CMD ["/wait-for-it.sh", "mysql:3306", "--timeout=30", "--strict", "--", "apache2-foreground"]
