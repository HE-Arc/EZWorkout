FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

EXPOSE 8000

COPY app /app

RUN cd /app && cp .env.example .env
RUN cd /app && composer install

CMD cd /app && php artisan key:generate && php artisan db:wipe && php artisan migrate && php artisan db:seed && php artisan serve
