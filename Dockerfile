FROM php:7.4-fpm

RUN apt-get update && apt-get install -y libmcrypt-dev \
libmagickwand-dev php7.4-mcrypt --no-install-recommends \
&& docker-php-ext-install mcrypt pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

EXPOSE 8000

COPY app /app

RUN cd /app && cp .env.example .env
RUN cd /app && composer install

CMD cd /app && php artisan generate:key && php artisan migrate && php artisan serve
