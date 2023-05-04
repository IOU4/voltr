FROM mariadb:10.9.5
COPY ./api/database.sql /docker-entrypoint-initdb.d/database.sql
