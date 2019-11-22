<?php

define('YII_ENV', 'dev');
define('YII_DEBUG', true);

require dirname(__DIR__).'/bootstrap.php';

/**
 * id和basePath是实例化Application类的必须参数
 *
 * @see http://www.yiiframework.com/doc-2.0/guide-structure-applications.html#required-properties
 */
$config = [
    'id' => 'yii2-log-web-dev',
    'basePath' => dirname(__DIR__),
    'timeZone' => 'Asia/Shanghai',
    'bootstrap' => [
        'log',
    ],
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'log' => [
            'targets' => [
                [
                    'class' => \zii\log\FluentTarget::class,
                    'host' => 'fluentd-forwarder',
                    'port' => 24224,
                ],
            ],
        ],
    ],
];

(new yii\web\Application($config))->run();
