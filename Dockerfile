FROM alpine:3.17 as registry-nginx-php-fpm

RUN apk -U upgrade && apk add --no-cache \
    curl \
    nginx \
    php81-fpm \
    php81 \
    tzdata \
    && ln -s /usr/sbin/php-fpm81 /usr/sbin/php-fpm \
    && addgroup --gid 1000 app \
    && adduser -S --uid 1000 -G app app \
    && mkdir -p /home/app /var/run/nginx /var/run/php /var/www/public \
    && chown -Rf app:app /home/app /var/run/nginx /var/run/php /var/www \
    && rm -rf /var/cache/apk/* /etc/nginx/conf.d/* /etc/php81/conf.d/* /etc/php81/php-fpm.d/*

COPY docker/nginx/nginx.conf /etc/nginx
COPY docker/nginx/conf.d /etc/nginx/conf.d
COPY docker/php/php-fpm.conf /etc/php81
COPY public/index.php /var/www/public

RUN chown -Rf app:app /var

WORKDIR /var/www

EXPOSE 8080

CMD php-fpm -D; sleep 1; nginx

HEALTHCHECK --interval=5s --timeout=5s CMD curl -f http://127.0.0.1:8080/fpm-ping || exit 1

FROM registry-nginx-php-fpm as production

RUN set -xe \
    && apk -U --no-cache add \
        nano \
        php81-curl \
        php81-iconv \
        php81-json \
        php81-mbstring \
        php81-phar \
        php81-openssl \
        php81-session \
        php81-tokenizer \
        php81-fileinfo \
        php81-xml \
        php81-simplexml \
        php81-xmlwriter \
        php81-dom \
        php81-pdo \
        php81-cli \
        php81-pdo_pgsql \
        php81-mysqli \
        php81-pdo_mysql \
        php81-redis \
        php81-ctype \
        php81-opcache \
    && rm -rf /var/cache/apk/*

COPY --chown=app:app . /var/www
COPY docker/php/conf.d/php.prod.ini /etc/php81/conf.d/php.ini

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/bin --filename=composer
RUN rm -rf composer-setup.php

RUN composer install -o --no-dev --prefer-dist --no-progress \
    && cp .env.example .env \
    && ./artisan key:generate --ansi \
    && ./artisan route:cache \
    && ./artisan config:cache \
    && composer clear-cache

FROM production as local

# для локальной разработки очищаем кэш
RUN ./artisan route:clear \
    && ./artisan config:clear

COPY docker/php/conf.d/php.develop.ini /etc/php81/conf.d/php.ini