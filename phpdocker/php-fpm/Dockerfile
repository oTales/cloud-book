FROM phpdockerio/php:8.1-fpm
WORKDIR "/application"

RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        git \
        php8.1-mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* \

RUN docker-php-ext-install mysqli pdo pdo_mysql > /etc/php/8.1/fpm/conf.d/mysql.ini

RUN service php8.1-fpm restart
