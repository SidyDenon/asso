# Utilise l'image officielle PHP avec Apache
FROM php:8.2-apache

# Installe les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    zip unzip git libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Active le mod_rewrite pour Laravel
RUN a2enmod rewrite

# Installe Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier les fichiers du projet
COPY . /var/www/html

# Se placer dans le dossier
WORKDIR /var/www/html

# Installer les dépendances PHP
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Définir les permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Copie .env.prod si tu veux, ou configure directement via Render
# COPY .env.prod .env

# Expose le port 80
EXPOSE 80

CMD php artisan migrate --force && apache2-foreground
