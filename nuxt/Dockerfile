FROM nginx:stable-alpine3.17-slim
RUN mkdir -p /usr/share/nginx/voltr
WORKDIR /app
COPY ./nuxt/.output/public  .
COPY ./nginx.conf /etc/nginx/
ENV GID=1000
ENV UID=1000
