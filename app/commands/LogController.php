<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

class LogController extends Controller
{
    /**
     * 记录级别为 `error` 的日志
     *
     * @param string $message 日志消息
     */
    public function actionError($message)
    {
        Yii::error($message);
    }
}
