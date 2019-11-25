# PHP FPM 镜像

FROM modicn/php-dev:7.1-fpm-alpine

# 使用 php 用户运行 PHP-FPM 工作进程

ARG X_GID
ARG X_UID

RUN if [ -z "`getent group ${X_GID}`" ]; then \
        addgroup -S -g ${X_GID} php; \
    fi; \
    adduser -S -D -u ${X_UID} -G `getent group ${X_GID} | cut -d: -f1` php

RUN { \
        echo '[www]'; \
        echo "user = ${X_UID}"; \
        echo "group = ${X_GID}"; \
        echo "listen = 0.0.0.0:9000"; \
    } | tee /usr/local/etc/php-fpm.d/zz-zz.conf

# Composer 缓存

ENV COMPOSER_HOME /tmp/composer
RUN mkdir ${COMPOSER_HOME} && \
    chown ${X_UID}:${X_GID} ${COMPOSER_HOME}

WORKDIR /project
