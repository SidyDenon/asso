# Utiliser PHP + Apache
FROM php:8.2-apache

# Installer les extensions nécessaires
RUN apt-get update && apt-get install -y \
    zip unzip git libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Activer mod_rewrite
RUN a2enmod rewrite

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier le projet
COPY . /var/www/html

# Aller dans le dossier
WORKDIR /var/www/html

# Installer les dépendances
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Donner les permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Générer la clé si pas déjà faite
RUN php artisan key:generate --force

# Migrer la base au démarrage (Render relance souvent le conteneur)
CMD php artisan migrate --force && apache2-foreground

EXPOSE 80
