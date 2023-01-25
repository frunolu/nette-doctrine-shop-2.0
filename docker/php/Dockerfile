FROM php:8.1.10-fpm

ARG APP_WORK_DIR=/project
ARG COMPOSER_VERSION=2.3.10
ARG COMPOSER_SHA256=d808272f284fa8e0f8b470703e1438ac8f362030bbc9d12e29530277d767aff0

RUN \
 apt-get update && \
 apt-get install -y vim git curl zip unzip

RUN curl -Ls "https://getcomposer.org/download/${COMPOSER_VERSION}/composer.phar" > /usr/local/bin/composer && \
    test "$(sha256sum /usr/local/bin/composer | cut -d ' ' -f 1)" = "${COMPOSER_SHA256}" && \
    chmod +x /usr/local/bin/composer && \
    chown www-data:www-data /usr/local/bin/composer

# Setup environment
ENV DEV=1
RUN mkdir -p $APP_WORK_DIR
RUN chmod -R 755 $APP_WORK_DIR

WORKDIR $APP_WORK_DIR
