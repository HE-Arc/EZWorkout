FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libmagickwand-dev
    
RUN curl -sL https://deb.nodesource.com/setup_13.x -o nodesource_setup.sh
RUN bash nodesource_setup.sh
RUN apt-get install nodejs -y
RUN npm install npm@6.13.0 -g

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
RUN printf "\n" | pecl install imagick
RUN docker-php-ext-enable imagick

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

EXPOSE 8000

COPY app /app
WORKDIR /app

RUN cp .env.example .env
RUN composer install
RUN chmod +x run.sh
RUN npm install
RUN npm run dev

CMD ./run.sh
