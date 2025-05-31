FROM php:8.2-apache

# Copy all your app files into Apache's web root
COPY . /var/www/html/

# Enable Apache mod_rewrite (optional, but useful for routing)
RUN a2enmod rewrite \
&& echo "ServerName localhost" >> /etc/apache2/apache2.conf

EXPOSE 80
