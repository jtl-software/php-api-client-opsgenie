FROM php:7.2-fpm
#FROM phpdockerio/php71-fpm:latest

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get install -y vim libpng-dev libfreetype6-dev libjpeg62-turbo-dev zlib1g-dev \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# RUN docker-php-ext-install mysqli
# RUN docker-php-ext-install pdo
# RUN docker-php-ext-install pdo_mysql
# RUN docker-php-ext-install mbstring
# RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
# RUN docker-php-ext-install gd
# RUN docker-php-ext-install zip
# RUN docker-php-ext-install bcmath
# RUN docker-php-ext-install exif
# RUN docker-php-ext-install xdebug
# RUN docker-php-ext-install xml

WORKDIR "/application"