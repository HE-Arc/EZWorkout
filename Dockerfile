FROM php:7.1.3-fpm

RUN apt-get update && apt-get install -y libmcrypt-dev \
mysql-client libmagickwand-dev --no-install-recommends \
&& pecl install imagick \
&& docker-php-ext-enable imagick \
&& docker-php-ext-install mcrypt pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

EXPOSE 8000

COPY app /app

RUN cd /app && cp .env.exemple .env
RUN cd /app && composer install -q --no-ansi --no-interaction --no-scripts --no-progress --prefer-dist

CMD cd /app && php artisan generate:key && php artisan migrate && php artisan serve