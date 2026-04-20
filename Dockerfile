FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
   git unzip libzip-dev libicu-dev libpng-dev \
   && docker-php-ext-install intl zip gd pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# install dependency dulu
RUN composer install --no-dev --optimize-autoloader

# setup sqlite
RUN mkdir -p database && touch database/database.sqlite

# permission
RUN chmod -R 777 storage bootstrap/cache database

# generate key + migrate
RUN  php artisan migrate --force && \
   php artisan config:clear && \
   php artisan cache:clear

# start server (IMPORTANT)
CMD php -S 0.0.0.0:${PORT:-8000} -t public