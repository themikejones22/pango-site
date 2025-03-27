# Use an official PHP image
FROM php:8.1-apache

# Install required extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable mod_rewrite for Apache
RUN a2enmod rewrite

# Set the working directory
WORKDIR /var/www/html

# Copy project files to the container
COPY . /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
