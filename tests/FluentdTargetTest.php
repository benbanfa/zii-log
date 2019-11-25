<?php

namespace zii\log\tests;

use Yii;
use yii\log\Logger;
use zii\log\FluentdTarget;

class FluentdTargetTest extends WebAppTestCase
{
    public function testFormatMessage()
    {
        $user = new User('USER_ID');
        Yii::$app->getUser()->setIdentity($user);

        $target = new FluentdTarget();

        $now = microtime(true);
        $formatted = $target->formatMessage([
            '消息',
            Logger::LEVEL_ERROR,
            str_repeat('c', 300),
            $now,
        ]);

        $this->assertEquals($formatted, [
            'time' => date('Y-m-d H:i:s', $now),
            'level' => 'error',
            'message' => '消息',
            'data' => null,
            'appId' => 'yii2-log-web-test',
            'category' => str_repeat('c', 200),
            'userId' => 'USER_ID',
            'sessionId' => null,
            'remoteIp' => null,
        ]);
    }
}
