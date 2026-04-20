FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
   git unzip libzip-dev libicu-dev libpng-dev \
   && docker-php-ext-install intl zip gd pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader

CMD php artisan serve --host=0.0.0.0 --port=8000