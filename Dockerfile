FROM node:18.16.0-alpine3.16 as build

WORKDIR /app
COPY ./nuxt  .

RUN npm i
RUN npx nuxi build --prerender --dotenv .env

FROM nginx:stable-alpine3.17-slim
RUN mkdir -p /usr/share/nginx/voltr

WORKDIR /app

RUN mkdir .logs/
RUN touch .logs/error.log

RUN mkdir nuxt
COPY --from=build /app/.output/public  nuxt

RUN mkdir api
COPY ./api api

RUN mkdir logs
RUN touch logs/error.log

COPY ./nginx.conf /etc/nginx/nginx.conf
