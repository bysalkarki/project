FROM php:8.0-fpm-alpine

ARG APCU_VERSION=5.1.18

# Get frequently used tools
RUN apk update && apk add --no-cache \
    build-base \
    icu-dev \
    libzip-dev \
    libpng-dev \
    openssl-dev \
    jpeg-dev \
    libwebp-dev \
    freetype-dev \
    oniguruma-dev \
    libjpeg-turbo-dev \
    libpng \
    libzip \
    unzip \
    jpegoptim \
    optipng \
    pngquant \
    gifsicle \
    vim \
    git \
    curl \
    wget \
    zsh

RUN docker-php-ext-configure zip

RUN docker-php-ext-install \
    bcmath \
    mbstring \
    pcntl \
    intl \
    zip \
    pdo_mysql \
    opcache

RUN docker-php-ext-install sockets

## INSTALL GD
RUN apk add --no-cache \
    freetype \
    libjpeg-turbo \
    libwebp \
    libpng \
    libxpm \
    libzip-dev && \
    docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    --with-webp && \
    docker-php-ext-install -j$(nproc) gd && \
    docker-php-ext-enable gd

## INSTALL EXIF
RUN docker-php-ext-install exif && \
    docker-php-ext-enable exif

## INSTALL OPCACHE
RUN docker-php-ext-install opcache && \
    docker-php-ext-enable opcache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer