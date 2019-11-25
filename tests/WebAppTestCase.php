<?php

namespace zii\log\tests;

use PHPUnit\Framework\TestCase;
use Yii;
use yii\di\Container;
use yii\web\Application;

/**
 * Web 场景测试用例基类
 */
abstract class WebAppTestCase extends TestCase
{
    protected function setUp(): void
    {
        $config = [
            'class' => Application::class,
            'id' => 'yii2-log-web-test',
            'basePath' => __DIR__,
            'timeZone' => 'Asia/Shanghai',
            'components' => [
                'db' => [
                    'class' => 'yii\db\Connection',
                    'dsn' => 'mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_DATABASE'],
                    'username' => $_ENV['DB_USERNAME'],
                    'password' => $_ENV['DB_PASSWORD'],
                    'charset' => $_ENV['DB_CHARSET'],
                ],
                'user' => [
                    'identityClass' => User::class,
                ],
            ],
        ];

        Yii::createObject($config);
    }

    protected function tearDown(): void
    {
        Yii::$app = null;
        Yii::$container = new Container();
    }
}
