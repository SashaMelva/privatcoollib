FROM phpdockerio/php:8.2-fpm
WORKDIR "/privatcoollib"

RUN apt-get update; \
    apt-get -y --no-install-recommends install \
        php8.2-http \
        php8.2-xdebug \
        php8.2-xmlrpc \
        php8.2-raphf; \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN curl -sS https://getcomposer.org/installer | \
    php -- --2 --install-dir=/usr/local/bin --filename=composer \