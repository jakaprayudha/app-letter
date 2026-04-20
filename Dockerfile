FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
   git unzip libzip-dev libicu-dev libpng-dev \
   && docker-php-ext-install intl zip gd pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# install dependency
RUN composer install --no-dev --optimize-autoloader

# permission
RUN chmod -R 777 storage bootstrap/cache

# clear cache
RUN php artisan config:clear && php artisan cache:clear

# START APP (INI KUNCI)
CMD mkdir -p /app/database && \
   touch /app/database/database.sqlite && \
   chmod -R 777 /app/database && \
   php artisan migrate --force && \
   php -S 0.0.0.0:${PORT:-8000} -t public