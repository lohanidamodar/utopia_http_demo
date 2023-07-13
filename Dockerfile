FROM composer:2.0 AS step0


ARG TESTING=true

ENV TESTING=$TESTING

WORKDIR /usr/local/src/

COPY composer.* /usr/local/src/

RUN composer install --ignore-platform-reqs --optimize-autoloader \
    --no-plugins --no-scripts --prefer-dist \
    `if [ "$TESTING" != "true" ]; then echo "--no-dev"; fi`

FROM appwrite/base:0.2.2 as final
LABEL maintainer="team@appwrite.io"

WORKDIR /usr/src/code

COPY ./src /usr/src/code/src
COPY ./app /usr/src/code/app
COPY ./public /usr/src/code/public
COPY --from=step0 /usr/local/src/vendor /usr/src/code/vendor

EXPOSE 80

CMD ["php", "app/http.php"]
