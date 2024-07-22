# syntax=docker/dockerfile:1

FROM composer:lts as deps
WORKDIR /app
RUN --mount=type=bind,source=composer.json,target=composer.json \
    --mount=type=bind,source=composer.lock,target=composer.lock \
    --mount=type=cache,target=/tmp/cache \
    composer install --no-dev --no-interaction

FROM php:8.3.9-cli as final
RUN docker-php-ext-install pdo pdo_pgsql
COPY --from=deps /app/vendor/ /var/www/html/vendor
COPY ./src /var/www/html

WORKDIR /var/www/html
CMD ["php", "-S", "0.0.0.0:8000", "-t", "."]