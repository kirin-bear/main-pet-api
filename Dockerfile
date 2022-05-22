FROM alpine:3.13 as registry-nginx-php-fpm

RUN apk -U upgrade && apk add --no-cache \
    curl \
    nginx \
    php7-fpm \
    php7 \
    tzdata \
    && ln -s /usr/sbin/php-fpm7 /usr/sbin/php-fpm \
    && addgroup --gid 1000 app \
    && adduser -S --uid 1000 -G app app \
    && mkdir -p /home/app /var/run/nginx /var/run/php /var/www/public \
    && chown -Rf app:app /home/app /var/run/nginx /var/run/php /var/www \
    && rm -rf /var/cache/apk/* /etc/nginx/conf.d/* /etc/php7/conf.d/* /etc/php7/php-fpm.d/*

COPY docker/nginx/nginx.conf /etc/nginx
COPY docker/nginx/conf.d/default.conf /etc/nginx/conf.d
COPY docker/php/php-fpm.conf /etc/php7
COPY public/index.php /var/www/public

RUN chown -Rf app:app /var

WORKDIR /var/www

EXPOSE 8080

CMD php-fpm -D; sleep 1; nginx

HEALTHCHECK --interval=5s --timeout=5s CMD curl -f http://127.0.0.1:8080/fpm-ping || exit 1

FROM registry-nginx-php-fpm as prod

RUN set -xe \
    && apk -U --no-cache add \
        nano \
        php7-curl \
        php7-iconv \
        php7-json \
        php7-mbstring \
        php7-phar \
        php7-openssl \
        php7-session \
        php7-tokenizer \
        php7-fileinfo \
        php7-xml \
        php7-simplexml \
        php7-xmlwriter \
        php7-dom \
        php7-pdo \
        php7-pdo_pgsql \
        php7-redis \
        php7-ctype \
        php7-opcache \
    && rm -rf /var/cache/apk/*

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer
COPY --chown=app:app . /var/www
COPY docker/php/conf.d/php.prod.ini /etc/php7/conf.d/php.ini

FROM prod as develop

COPY docker/php/conf.d/php.develop.ini.ini /etc/php7/conf.d/php.ini