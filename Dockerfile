FROM php:8.0-apache

RUN \
    apt-get update && \
    apt-get install -y libpq-dev && \
    apt install -y curl && \
    docker-php-ext-install pdo pdo_pgsql 
    
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

COPY . /var/www/html

WORKDIR /var/www/html
