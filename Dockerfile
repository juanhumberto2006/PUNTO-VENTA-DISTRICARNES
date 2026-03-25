FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql pgsql

RUN a2enmod rewrite

COPY --chown=www-data:www-data . /var/www/html/

RUN chmod -R 755 /var/www/html/

WORKDIR /var/www/html
