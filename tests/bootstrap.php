<?php

define('YII_ENV', 'test');
define('YII_DEBUG', true);

require dirname(__DIR__).'/vendor/autoload.php';

if (!isset($_ENV['YII_ENV'])) {
    $dotenv = Dotenv\Dotenv::create(__DIR__);
    $dotenv->load();
}

require dirname(__DIR__).'/vendor/yiisoft/yii2/Yii.php';
