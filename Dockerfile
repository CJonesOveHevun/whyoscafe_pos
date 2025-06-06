FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libssl-dev pkg-config libcurl4-openssl-dev unzip curl git

RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

RUN a2enmod rewrite \
    && echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory to Apache's web root
WORKDIR /var/www/html

# Copy your app to that path
COPY . /var/www/html/

RUN composer install --no-dev --optimize-autoloader
EXPOSE 80
