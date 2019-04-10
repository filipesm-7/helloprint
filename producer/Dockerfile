#specify base image
FROM php:7-apache

#update apt and install tools
RUN apt-get update && apt-get install -y \
    wget \
    vim

#enable apache rewrite module
RUN a2enmod rewrite

#install php extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql bcmath sockets

#overwrite apache2 port configuration
COPY ./apache2/producer/ports.conf /etc/apache2/ports.conf
COPY ./apache2/producer/000-default.conf /etc/apache2/sites-enabled/000-default.conf

#copy files to server root
COPY ./producer /var/www/html


