
FROM php:8.3-apache


RUN a2enmod rewrite


RUN apt-get update && apt-get install -y libcurl4-openssl-dev \
    && docker-php-ext-install curl \
    && rm -rf /var/lib/apt/lists/*
 
WORKDIR /var/www/html
 
COPY . .
 
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html
 
EXPOSE 80
