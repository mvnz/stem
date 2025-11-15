# Image PHP + Apache
FROM php:8.2-apache

# Install ekstensi yg dibutuhin Laravel (sesuai kebutuhan, ini standar)
RUN docker-php-ext-install pdo_mysql

# Aktifin mod_rewrite biar route Laravel jalan
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy composer dari image resmi
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy semua file project ke container
COPY . .

# Install dependency Laravel
RUN composer install --no-dev --optimize-autoloader

# Set DocumentRoot Apache ke folder public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf

# Port web
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
