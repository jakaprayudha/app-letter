FROM php:8.2-cli

# Install dependencies + extensions
RUN apt-get update && apt-get install -y \
   git unzip libzip-dev libicu-dev \
   && docker-php-ext-install intl zip pdo pdo_mysql

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader

CMD php artisan serve --host=0.0.0.0 --port=8000