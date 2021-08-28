FROM php:7.4-apache

# Configurazione Apache
RUN a2enmod rewrite && a2enmod session && a2enmod headers
COPY ./docker/apache2 /etc/apache2/

# Configurazione PHP
COPY ./docker/php/php.ini "$PHP_INI_DIR/conf.d/php.ini"

# Installazione estensioni PHPs
RUN docker-php-ext-install pdo pdo_mysql mysqli

COPY . /var/www/html/