FROM php:8.4-cli

# system deps + node 18 (WAJIB untuk Vite)
RUN apt-get update && apt-get install -y \
   git unzip libzip-dev libicu-dev libpng-dev curl \
   && docker-php-ext-install intl zip gd pdo pdo_mysql \
   && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
   && apt-get install -y nodejs

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# install php deps dulu (lebih aman untuk artisan command)
RUN composer install --no-dev --optimize-autoloader

# 🔥 build frontend
RUN npm install
RUN npm run build

# optional (Filament)
RUN php artisan filament:assets || true

# debug: pastikan build ada
RUN ls -la public/build

# sqlite setup
RUN mkdir -p /app/database && touch /app/database/database.sqlite

# permission
RUN chmod -R 777 storage bootstrap/cache /app/database

# clear cache
RUN php artisan config:clear && php artisan cache:clear

# start app
CMD sh -c "\
   php artisan view:clear && \
   php artisan config:clear && \
   php artisan migrate --force && \
   php -S 0.0.0.0:${PORT:-8000} -t public \
   "
