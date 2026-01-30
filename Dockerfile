# FROM php:8.3-apache

# # Activer mod_rewrite
# RUN a2enmod rewrite

# # Autoriser l'usage des .htaccess
# COPY apache/vhost.conf /etc/apache2/sites-available/000-default.conf

# # (optionnel) extensions PHP courantes
# RUN docker-php-ext-install mysqli pdo pdo_mysql

# WORKDIR /var/www/html


FROM php:8.3-apache

# Apache: rewrite + (si besoin) headers
RUN a2enmod rewrite headers

# Extensions PHP (PDO MySQL)
RUN docker-php-ext-install pdo pdo_mysql

# VHost qui autorise .htaccess
COPY apache/vhost.conf /etc/apache2/sites-available/000-default.conf

# Copier le code du site dans l'image
COPY src/ /var/www/html/

# (Optionnel) sécuriser droits (Apache tourne en www-data)
RUN chown -R www-data:www-data /var/www/html

WORKDIR /var/www/html

