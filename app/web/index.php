<?php

// HTTP 程序入口文件

require dirname(__DIR__).'/bootstrap.php';

/**
 * id和basePath是实例化Application类的必须参数
 *
 * @see http://www.yiiframework.com/doc-2.0/guide-structure-applications.html#required-properties
 */
$config = [
    'id' => 'yii2-log-web-dev',
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
];

$config = \yii\helpers\ArrayHelper::merge(
    require dirname(__DIR__).'/config/common.php',
    $config
);

(new yii\web\Application($config))->run();
