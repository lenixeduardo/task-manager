FROM php:7.4-apache

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY ./src /var/www/html/


RUN a2enmod rewrite