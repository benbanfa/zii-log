# Yii2 日志扩展

对日志采集（日志管理的环节之一）常提出以下需求：

- 日志集中
- 日志不易失
- 支持集群化，提高可靠性
- 可控制日志采集归档的延迟（如某些调试场景，希望日志能尽快归档）
- 日志信息的结构化

Fluentd 是满足以上需求的日志中间件。

本项目评估了 PHP 写日志的三种方式：

- 写文件日志
- 写 stdout
- 通过网络发送日志给 Fluentd 实例

提供了 FluentdTarget PHP 类，实现了通过网络发送日志给 Fluentd 实例。

为方便开发、调试，本项目也提供了将日志归档至 MySQL 数据库的 Docker Compose 配置：

    [日志] --> [Fluentd 转发实例] --> [Fluentd 汇总实例] --> [MySQL 数据库]

## 目录说明

    app/                    为调试该扩展而打包的 Yii2 应用
        commands/           命令行脚本
        controllers/        Web 控制器
        var/                工作目录
        web/                Web 服务根目录
    docker/                 Docker Compose 配置
        fluentd-forwarder/  Fluentd 转发实例配置
        fluentd-sink/       Fluentd 汇总实例 Dockerfile 及配置
        mysql/              MySQL 配置
            init.d/         初始化数据库的 SQL
        nginx/              Nginx 配置
        php-fpm             PHP-FPM Dockerfile 及 PHP 配置
    docs/                   文档
    src/                    功能代码主目录
    tests/                  测试代码目录
    vendor/                 PHP Composer 依赖安装目录

提示：对重要文件的说明，可阅读文件首部的注释。

## 在 Yii2 项目里使用该扩展

修改 Yii2 应用的配置：

    return [
        'bootstrap' => [
            'log',
        ],
        'components' => [
            'log' => [
                'targets' => [
                    [
                        'class' => \zii\log\FluentTarget::class,
                        'levels' => ['error', 'warning'],
                        'host' => 'fluentd-forwarder', // Fluentd 实例地址
                        'port' => 24224, // Fluentd 实例端口
                    ],
                ],
            ],
        ]
    ];

## 开发与验证

以下是使用 Docker Compose 配置的说明。

### 创建 Docker Compose 的 .env 文件

在 `docker` 目录里，参考 `.env.example` 文件创建 `.env` 文件。

提示：请理解各配置项的含义。

### 运行 Docker Compose 项目

在 `docker` 目录里，执行：

    docker-compose up -d

提示：请确认各容器成功启动。

### 在 PHP-FPM 容器里安装 PHP Composer 依赖

略。

### 创建 PHP 项目的 .env 文件

在 `app` 目录里，参考 `.env.example` 创建 `.env` 文件。

提示：请理解各配置项的含义。

### 在 PHP 项目里写代码，产生日志

本项目提供了产生 `error` 级别日志的命令行程序，在 `php-fpm` 容器里执行：

    ./app/yii log/error 日志内容

提示：确认日志能够被收录到数据库中。
