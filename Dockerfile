FROM alpine:3.13

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
