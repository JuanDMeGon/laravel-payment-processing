FROM php:7.3-fpm-alpine

RUN apk add --no-cache --virtual .phpize-deps $PHPIZE_DEPS \
    openssl \
    bash \
    nano \
    mysql-client \
    nodejs \
    npm \
    git \
    libzip-dev \
    && docker-php-ext-configure zip --with-libzip=/usr/include \
    && docker-php-ext-install pdo_mysql pcntl zip \
    && pecl install redis && docker-php-ext-enable redis

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

ENTRYPOINT [ ".docker/entrypoint" ]