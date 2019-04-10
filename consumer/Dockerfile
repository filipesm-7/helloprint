#specify base image
FROM php:7-apache

#update apt and install tools
RUN apt-get update && apt-get install -y \
    vim

#install php extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql bcmath sockets

#overwrite apache2 port configuration
COPY ./apache2/consumer/ports.conf /etc/apache2/ports.conf
COPY ./apache2/consumer/000-default.conf /etc/apache2/sites-enabled/000-default.conf

#copy files to server root
COPY ./consumer /var/www/html


