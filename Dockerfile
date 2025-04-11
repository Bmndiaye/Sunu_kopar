# Base image PHP avec FPM
FROM php:8.3-fpm

# Installation des dépendances système et extensions PHP nécessaires
RUN apt-get update && apt-get install -y --no-install-recommends \
    zip unzip git curl supervisor nginx \
    libpq-dev libgd-dev libonig-dev libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql gd zip mbstring \
    && rm -rf /var/lib/apt/lists/*

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définition du dossier de travail
WORKDIR /var/www

# Copie uniquement les fichiers Composer avant d'installer les dépendances
COPY composer.json composer.lock ./

# Correction des permissions avant d'exécuter Composer
RUN chmod -R 775 /var/www

# Installation des dépendances PHP sans exécuter les scripts post-install
RUN composer install --no-dev --prefer-dist --no-interaction --no-progress --optimize-autoloader --no-scripts

# Copie du reste du code source
COPY . .

# Création des répertoires nécessaires à Laravel (évite l'erreur de compilation Blade)
RUN mkdir -p \
    storage/framework/{cache,sessions,views} \
    storage/logs \
    bootstrap/cache

# Application des bonnes permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Copie de la configuration NGINX
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Exposition des ports HTTP et PHP-FPM
EXPOSE 80 9000

# Commande de démarrage pour PHP-FPM et NGINX
CMD ["sh", "-c", "service nginx start && php-fpm"]
