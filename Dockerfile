# Utiliser l'image officielle PHP avec Apache
FROM php:8.2-apache

# Installer les extensions nécessaires
RUN apt-get update && apt-get install -y \
    zip unzip git libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Activer mod_rewrite pour Laravel
RUN a2enmod rewrite

# Copier composer depuis l'image officielle
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier le projet dans le conteneur
COPY . /var/www/html

# Aller dans le répertoire
WORKDIR /var/www/html

# Installer les dépendances composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Lancer les migrations directement pendant le build
RUN php artisan migrate --force

# Donner les bons droits
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exposer le port
EXPOSE 80
