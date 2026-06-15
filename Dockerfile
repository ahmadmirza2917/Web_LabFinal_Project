FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring xml bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN rm -f .env

RUN composer install --no-dev --optimize-autoloader

RUN chmod -R 777 storage bootstrap/cache

# Make start script executable
RUN chmod +x start.sh

EXPOSE 8000

# JSON format — no more warning
CMD ["/bin/sh", "start.sh"]