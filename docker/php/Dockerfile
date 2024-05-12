FROM php:8.1.10-fpm

ARG APP_WORK_DIR=/project
ARG COMPOSER_VERSION=2.3.10
ARG COMPOSER_SHA256=d808272f284fa8e0f8b470703e1438ac8f362030bbc9d12e29530277d767aff0

RUN \
 usermod -u 1000 www-data && \
 groupmod -g 1000 www-data && \
 usermod -d /home/www-data -m -s /bin/bash www-data && \
 chown -R www-data:www-data /home/www-data

RUN \
 apt-get update && \
 apt-get install -y vim git curl zip unzip libgd-dev libpng-dev libjpeg-dev libzip-dev libexif-dev libicu-dev libxml2-dev libcurl4-openssl-dev gettext

RUN curl -Ls "https://getcomposer.org/download/${COMPOSER_VERSION}/composer.phar" > /usr/local/bin/composer && \
    test "$(sha256sum /usr/local/bin/composer | cut -d ' ' -f 1)" = "${COMPOSER_SHA256}" && \
    chmod +x /usr/local/bin/composer && \
    chown www-data:www-data /usr/local/bin/composer

RUN curl -sL https://deb.nodesource.com/setup_18.x | bash \
    && apt-get install nodejs -y

# xdebug
RUN pecl install xdebug && \
    docker-php-ext-enable xdebug

RUN docker-php-ext-configure intl
RUN docker-php-ext-install pdo_mysql zip gd exif intl curl dom gettext pdo

RUN \
 docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-freetype=/usr/include/

RUN pecl install redis \
    && docker-php-ext-enable redis

# Setup environment
ENV DEV=1
RUN mkdir -p $APP_WORK_DIR
RUN chmod -R 755 $APP_WORK_DIR
RUN chown -R www-data:www-data $APP_WORK_DIR

WORKDIR $APP_WORK_DIR
