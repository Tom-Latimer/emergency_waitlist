# syntax=docker/dockerfile:1

FROM php:8.3.9-cli
RUN apt-get update && apt-get install -y \
    libpq-dev \
    git \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www/html

# Copy the Composer files and install dependencies
COPY composer.json composer.lock ./

# Copy the rest of your application files
COPY . .

RUN composer install --no-dev --optimize-autoloader

# Expose port 8000 for the local PHP server
EXPOSE 8000

# Command to run the PHP local development server
CMD ["php", "-S", "0.0.0.0:8000"]