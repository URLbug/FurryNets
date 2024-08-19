FROM php:8.3-fpm

WORKDIR /var/www/laravel

RUN apt-get update && apt-get install -y libjpeg-dev libpng-dev

RUN docker-php-ext-configure gd --enable-gd --with-jpeg

RUN docker-php-ext-install gd

RUN docker-php-ext-install pdo pdo_mysql