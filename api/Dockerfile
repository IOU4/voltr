FROM php:8.1-fpm-alpine3.17

WORKDIR /app
COPY ./api .
RUN chmod -R 777 uploaded/

# install composer 
RUN <<EOF
  EXPECTED_CHECKSUM="$(php -r 'copy("https://composer.github.io/installer.sig", "php://stdout");')"
  php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
  ACTUAL_CHECKSUM="$(php -r "echo hash_file('sha384', 'composer-setup.php');")"
  if [ "$EXPECTED_CHECKSUM" != "$ACTUAL_CHECKSUM" ]
  then
      >&2 echo 'ERROR: Invalid installer checksum'
      rm composer-setup.php
      exit 1
  fi
  php composer-setup.php --quiet
  RESULT=$?
  rm composer-setup.php
  exit $RESULT
EOF

RUN  ./composer.phar update

# install mysqli php extension
RUN docker-php-ext-install mysqli
