# Utiliser l'image officielle PHP avec Apache
FROM php:8.2-apache

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql

# Copier le code dans le container
COPY . /var/www/html

# Changer le répertoire de travail
WORKDIR /var/www/html

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Installer les dépendances
RUN composer install --no-dev --optimize-autoloader

# Générer la clé
RUN php artisan key:generate

# Ouvrir le port
EXPOSE 80

# Lancer Apache en premier plan
CMD ["apache2-foreground"]
