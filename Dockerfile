FROM php:8.1-apache
RUN a2enmod rewrite
COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html
EXPOSE 80

RUN apt-get update && apt-get install -y sqlite3
COPY init.sql /init.sql
RUN sqlite3 /var/www/html/database.sqlite < /init.sql
