FROM php:8.0-fpm

RUN apt-get update && apt-get install -y pkg-config libcurl4-openssl-dev libzip-dev zip unzip

RUN docker-php-ext-install curl zip pdo_mysql bcmath

RUN curl -sS https://getcomposer.org/installer | php

RUN mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/html/app

EXPOSE 9000

CMD ["php-fpm", "-F"]