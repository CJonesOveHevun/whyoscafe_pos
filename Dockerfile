FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
libssl-dev pkg-config libcurl4-openssl-dev unzip curl

RUN pecl install mongodb \
&& docker-php-ext-enable mongodb

# Enable Apache mod_rewrite (optional, but useful for routing)
RUN a2enmod rewrite \
&& echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /the/workdir/path

# Copy all your app files into Apache's web root
COPY . /var/www/html/

RUN composer install --no-dev --optimize-autoloader

EXPOSE 80
