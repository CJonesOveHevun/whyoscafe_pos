# Use an official PHP image with Apache
FROM php:8.2-apache

# Copy all your app files into Apache's web root
COPY . /var/www/html/

# Enable Apache mod_rewrite (optional, but useful for routing)
RUN a2enmod rewrite

# Expose port 80 (default for HTTP)
EXPOSE 80
