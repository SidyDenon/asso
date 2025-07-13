# Utilise PHP avec Apache
FROM php:8.2-apache

# Installe extensions PHP
RUN apt-get update && apt-get install -y \
    zip unzip git libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Active mod_rewrite pour Laravel
RUN a2enmod rewrite

# Installe Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copie tout le code (tu es déjà dans monprojet grâce à rootDir)
COPY . /var/www/html

WORKDIR /var/www/html

# Installe les dépendances
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Donne les permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose Apache
EXPOSE 80

# Lance migrations et Apache
CMD php artisan migrate --force && apache2-foreground
