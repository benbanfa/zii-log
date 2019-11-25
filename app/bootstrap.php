<?php

// 自动加载

require dirname(__DIR__).'/vendor/autoload.php';
require dirname(__DIR__).'/vendor/yiisoft/yii2/Yii.php';

Yii::setAlias('@app', __DIR__);

// 环境变量的处理

if (!isset($_ENV['YII_ENV'])) {
    $dotenv = Dotenv\Dotenv::create(__DIR__);
    $dotenv->load();
}

defined('YII_ENV') or define('YII_ENV', $_ENV['YII_ENV'] ?? 'dev');
defined('YII_DEBUG') or define('YII_DEBUG', $_ENV['YII_DEBUG'] ?? true);
