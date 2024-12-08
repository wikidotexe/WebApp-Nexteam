# Use PHP 8.3 official image as base
FROM php:8.3-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libicu-dev \
    git \
    unzip && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd zip pdo pdo_mysql intl

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www

# Copy Laravel project files into the container
COPY . .

# Install Laravel dependencies
RUN composer install

# Set appropriate permissions for Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expose port 9000 for PHP
EXPOSE 9000

# Start PHP-FPM server
CMD ["php-fpm"]
