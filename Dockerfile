# build nuxt app
FROM node:lts-alpine3.17 as build
WORKDIR /app
COPY ./nuxt .
RUN npm i
RUN npx nuxi build --prerender --dotenv .env

# serve nuxt app
FROM nginx:stable-alpine3.17
RUN mkdir -p /usr/share/nginx/voltr
COPY --from=build /app/.output/public  /usr/share/nginx/voltr
COPY ./nginx.conf /etc/nginx/nginx.conf
