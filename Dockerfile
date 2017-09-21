FROM php:7.1.1-fpm-alpine
MAINTAINER "Jérôme Jutteau <mojo@jirafeau.net>"

RUN apk update && \
    apk add lighttpd git && \
    ln -snf /usr/share/zoneinfo/Etc/UTC /etc/localtime  && \
    echo "UTC" > /etc/timezone && \
    mkdir -p /usr/local/etc/php / && \
    mkdir /www

WORKDIR /www

COPY docker/php.ini /usr/local/etc/php/php.ini
COPY docker/lighttpd.conf /etc/lighttpd/lighttpd.conf
COPY *.php LICENSE.txt ./
COPY lib lib
COPY media media

RUN chown -R www-data. . && \
    chmod o=,ug=rwX -R . && \
    apk del git && \
    rm -rf /var/cache/apk/*

CMD php-fpm -D && lighttpd -D -f /etc/lighttpd/lighttpd.conf
EXPOSE 80
