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

# Ensure the file exists
RUN touch /var/www/html/visitors.txt

# Change ownership of the file and web directory to the www-data user
RUN chown -R www-data:www-data /var/www/html && chmod -R 775 /var/www/html

# Set permissions for visitors.txt specifically
RUN chmod 666 /var/www/html/visitors.t

# Start Apache server
CMD ["apache2-foreground"]
