FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    unzip curl pkg-config libssl-dev libcurl4-openssl-dev \
    libicu-dev libpq-dev git zip dnsutils libnss3 ca-certificates

RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

RUN a2enmod rewrite \
    && echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader


