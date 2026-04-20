FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
   git unzip libzip-dev libicu-dev libpng-dev \
   && docker-php-ext-install intl zip gd pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .
# install node
RUN apt-get install -y nodejs npm
# install & build frontend
RUN npm install && npm run build
RUN php artisan filament:assets
# install dependency
RUN composer install --no-dev --optimize-autoloader

# buat sqlite (FIXED)
RUN mkdir -p /app/database && \
   touch /app/database/database.sqlite

# permission
RUN chmod -R 777 storage bootstrap/cache /app/database

# clear cache
RUN php artisan config:clear && php artisan cache:clear

# entrypoint script inline
CMD sh -c "\
   ls -la /app/database && \
   php artisan config:clear && \
   php artisan cache:clear && \
   php artisan migrate --force && \
   php -S 0.0.0.0:${PORT:-8000} -t public \
   "