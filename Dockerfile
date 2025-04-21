# Base image PHP avec FPM
FROM php:8.3-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
    zip unzip git curl supervisor nginx \
    libpq-dev libgd-dev libonig-dev libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql gd zip mbstring \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY composer.json composer.lock ./

RUN chmod -R 775 /var/www

RUN composer install --no-dev --prefer-dist --no-interaction --no-progress --optimize-autoloader --no-scripts

COPY . .

RUN mkdir -p \
    storage/framework/{cache,sessions,views} \
    storage/logs \
    bootstrap/cache

RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

COPY docker/nginx.conf /etc/nginx/nginx.conf

EXPOSE 80 9000

CMD ["sh", "-c", "service nginx start && php-fpm"]
