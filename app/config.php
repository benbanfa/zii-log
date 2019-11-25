<?php

// 公共配置

return [
    'basePath' => __DIR__,
    'timeZone' => 'Asia/Shanghai',
    'bootstrap' => [
        'log',
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => \zii\log\FluentTarget::class,
                    'levels' => ['error', 'warning'],
                    'host' => 'fluentd-forwarder',
                    'port' => 24224,
                ],
            ],
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_DATABASE'],
            'username' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
            'charset' => $_ENV['DB_CHARSET'],
        ],
    ],
];
