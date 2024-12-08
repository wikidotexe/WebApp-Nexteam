# Use PHP 8.3 image
FROM php:8.3-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    libicu-dev \
    git \
    unzip \
    && docker-php-ext-configure zip \
    && docker-php-ext-install pdo pdo_mysql zip exif pcntl bcmath gd intl \
    && rm -rf /var/lib/apt/lists/*  # Clean up

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www

# Copy the Laravel project files into the container
COPY . .

# Install dependencies
RUN composer install

# Expose port 9000
EXPOSE 9000