FROM php:8.2-apache

# Install necessary dependencies
RUN apt-get update && apt-get install -y \
    libssl-dev \
    pkg-config \
    libcurl4-openssl-dev \
    ca-certificates \
    openssl \
    unzip \
    curl \
    gnupg \
    zip

# Reinstall CA certs with curl and force system trust
RUN curl -o /usr/local/share/ca-certificates/mongoCA.crt https://www.digicert.com/CACerts/DigiCertGlobalRootCA.crt.pem \
 && update-ca-certificates

RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

RUN a2enmod rewrite \
    && echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY . /var/www/html/


RUN composer install --no-dev --optimize-autoloader

EXPOSE 80
