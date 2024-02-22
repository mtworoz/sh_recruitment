FROM php:8.2-apache

RUN a2enmod rewrite
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

COPY . /var/www/html/

RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        ssh \
        libicu-dev \
        libpq-dev \
        libxslt-dev \
        libxslt-dev \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libc-client-dev \
        libkrb5-dev \
    && docker-php-ext-configure gd \
            --with-freetype \
            --with-jpeg \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure imap --with-kerberos --with-imap-ssl\
    && docker-php-ext-install \
        pdo_mysql soap opcache calendar zip intl pcntl pdo_pgsql xsl gd bcmath imap

RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/html

CMD composer install ; apache2-foreground
