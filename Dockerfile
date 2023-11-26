# Use the official PHP image as the base image
FROM php:8.2-cli

# Install required dependencies with Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy your PHP files to the container
COPY . /var/www/html

# Install dependencies
RUN composer install

# Expose the port your PHP application runs on
EXPOSE 80

# Command to run your PHP application
CMD ["php", "public/index.php"]

