FROM ubuntu:22.04
MAINTAINER "Vincent Michel"

ARG DEBIAN_FRONTEND=noninteractive
ARG COMPOSER_ALLOW_SUPERUSER=1
ARG PATH=/usr/sbin/:$PATH
ARG NODE_VERSION=20

WORKDIR "/usr/local/cardoc"

COPY . .

## Install required dependncies
RUN apt-get update && \
    apt-get install -y software-properties-common apt-utils git zip unzip curl libavif-dev

## Install Node and NPM
RUN curl -sLS https://deb.nodesource.com/setup_$NODE_VERSION.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm \
    && npm install -g pnpm

RUN apt-get install -y  \
    nginx git zip unzip curl

#Install PHP and extensions
RUN add-apt-repository ppa:ondrej/php
RUN apt-get update &&  \
    apt-get install -y php8.3 php8.3-cli php8.3-fpm
RUN apt-get install -y  php8.3-common php8.3-xml php8.3-zip php8.3-mysql php8.3-curl php8.3-mbstring php8.3-gd php8.3-intl php8.3-xsl php8.3-bcmath php8.3-imap php8.3-soap php8.3-readline php8.3-sqlite3 php8.3-gmp php8.3-redis
RUN echo php --version

## Install and run composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN echo composer --version

## Nginx default conf:
COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf

## PHPFPM default conf:
COPY docker/php-fpm/www.conf /etc/php/8.3/fpm/pool.d/www.conf
COPY docker/php/www.ini /etc/php/8.3/fpm/conf.d/99-www.ini

COPY docker/bash/entrypoint.sh /etc/entrypoint.sh
RUN chmod +x /etc/entrypoint.sh

# COPY docker/supervisor/laravel.conf /etc/supervisor/conf.d/laravel.conf

EXPOSE 80
EXPOSE 5173

ENTRYPOINT ["/etc/entrypoint.sh"]

