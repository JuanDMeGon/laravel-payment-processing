FROM php:7.3-fpm-alpine
RUN apk add --no-cache --virtual .phpize-deps $PHPIZE_DEPS \
    openssl \
    bash \
    nano \
    mysql-client \
    nodejs \
    npm \
    git \
    supervisor \
    libzip-dev \
    && docker-php-ext-configure zip --with-libzip=/usr/include
RUN docker-php-ext-install pdo_mysql pcntl zip
RUN pecl install redis && docker-php-ext-enable redis
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ADD supervisord.conf /etc/supervisor/conf.d/supervisord.conf
ADD cron /etc/crontabs/root
ADD entrypoint /usr/bin/entrypoint
RUN chmod +x /usr/bin/entrypoint
WORKDIR /var/www/html
EXPOSE 9000
ENTRYPOINT [ "entrypoint" ]