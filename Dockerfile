FROM nginx:stable-alpine3.17-slim
RUN mkdir -p /usr/share/nginx/voltr

WORKDIR /app

RUN mkdir .logs/
RUN touch .logs/error.log

RUN mkdir nuxt
COPY ./nuxt/.output/public  nuxt

RUN mkdir api
COPY ./api api

RUN mkdir logs
RUN touch logs/error.log

COPY ./nginx.conf /etc/nginx/nginx.conf
