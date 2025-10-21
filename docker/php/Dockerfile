FROM php:8.1-fpm

COPY php.ini /usr/local/etc/php/

RUN apt update \
  && apt install -y default-mysql-client zlib1g-dev libzip-dev unzip \
  && docker-php-ext-install pdo_mysql zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www