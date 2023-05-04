FROM php:8.1.3-fpm

WORKDIR /app

RUN mkdir api
COPY . api

RUN docker-php-ext-install mysqli
