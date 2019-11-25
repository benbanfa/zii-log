# Fluentd 汇总实例镜像

FROM fluentd:v1.6-1

USER root

RUN set -ex; \
    sed -i 's/dl-cdn.alpinelinux.org/mirrors.aliyun.com/g' /etc/apk/repositories; \
    apk update; \
    apk add --no-cache --virtual mysql2deps \
        ruby-dev \
        gcc \
        libc-dev \
        make \
        mariadb-dev; \
    fluent-gem install fluent-plugin-sql --no-document; \
    fluent-gem install mysql2 -v 0.5.2 --no-document; \
    apk del mysql2deps; \
    apk add --no-cache mariadb-connector-c

USER fluent