FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    locales

RUN locale-gen ru_RU.UTF-8 && \
    update-locale LANG=ru_RU.UTF-8

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

RUN chown -R www-data:www-data /var/www

ENV LANG=ru_RU.UTF-8
ENV LC_ALL=ru_RU.UTF-8
