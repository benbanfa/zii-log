# Yii2 日志扩展

该扩展实现了以下 [Yii2 日志 targets](https://www.yiiframework.com/doc/guide/2.0/en/runtime-logging#log-targets)：

- FluentdTarget 通过网络发送日志给 Fluentd 实例

如果你要验证、开发本扩展，可使用我们提供的 [Docker Compose 开发环境](https://github.com/benbanfa/zii-log-dev)。

## 目录说明

    docs/                   文档
    src/                    PHP 代码主目录
    tests/                  PHP 测试代码目录
    vendor/                 PHP Composer 依赖安装目录

提示：重要文件首部有注释。

## 在 Yii2 项目里使用该扩展

以 FluentdTarget 为例：

    // ...
    'bootstrap' => [
        'log',
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => \zii\log\FluentdTarget::class,
                    'levels' => ['error', 'warning'],
                    'host' => 'fluentd-forwarder', // Fluentd 实例地址
                    'port' => 24224, // Fluentd 实例端口
                ],
            ],
        ],
    ],
    // ...

