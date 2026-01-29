FROM php:8.3-apache

# Activer mod_rewrite
RUN a2enmod rewrite

# Autoriser l'usage des .htaccess
COPY apache/vhost.conf /etc/apache2/sites-available/000-default.conf

# (optionnel) extensions PHP courantes
RUN docker-php-ext-install mysqli pdo pdo_mysql

WORKDIR /var/www/html
