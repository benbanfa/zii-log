<?php

// 公共配置

return [
    'basePath' => dirname(__DIR__),
    'runtimePath' => dirname(__DIR__).'/var',
    'timeZone' => 'Asia/Shanghai',
    'bootstrap' => [
        'log',
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                ],
                [
                    'class' => \zii\log\FluentdTarget::class,
                    'levels' => ['error', 'warning'],
                    'host' => 'fluentd-forwarder',
                    'port' => 24224,
                ],
            ],
        ],
        'db' => [
            'class' => yii\db\Connection::class,
            'dsn' => 'mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_DATABASE'],
            'username' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
            'charset' => $_ENV['DB_CHARSET'],
        ],
    ],
];
