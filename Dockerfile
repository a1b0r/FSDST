FROM php:8.3-apache

# Install necessary PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite for URL routing
RUN a2enmod rewrite

# Copy application files to the Apache root directory
COPY . /var/www/html/

# Set the working directory
WORKDIR /var/www/html/

# Expose port 80 to the host
EXPOSE 80
