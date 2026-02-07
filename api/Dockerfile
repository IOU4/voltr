FROM php:8.1-fpm-alpine3.17

WORKDIR /app
COPY . .
RUN chmod -R 777 uploaded/

# install mysqli php extension
RUN docker-php-ext-install mysqli
