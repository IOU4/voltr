#!/bin/sh


# check id docker compose is available
if ! [ -x "$(command -v docker-compose)" ]; then
  echo 'Error: docker-compose is not installed.' >&2
  exit 1
fi

# check if compose file exits
if ! [ -f "docker-compose.yml" ]; then
  echo 'Error: docker-compose.yml not found.' >&2
  exit 1
fi

# make uploads directory
mkdir -p uploads
chmod -R 777 uploads

# run docker compose
docker-compose up -d


# install ssl cert after the app started 
sleep 10 
apk add --no-cache certbot-nginx
certbot --nginx --non-interactive --agree-tos --redirect --register-unsafely-without-email --domains emad.eu.org
