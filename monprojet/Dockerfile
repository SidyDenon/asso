# Utilise PHP avec Apache
FROM php:8.2-apache

# Installe les extensions nécessaires
RUN apt-get update && apt-get install -y \
    zip unzip git libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Active mod_rewrite pour Laravel
RUN a2enmod rewrite

# Installe Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copie ton projet
COPY . /var/www/html

WORKDIR /var/www/html

# Met Apache sur /public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Installe les dépendances PHP
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Donne les permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Lance migrations et Apache
CMD php artisan migrate --force && apache2-foreground
