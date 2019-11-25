<?php

namespace zii\log;

use Fluent\Logger\FluentLogger;
use Yii;
use yii\log\Logger;
use yii\log\Target;
use yii\web\Request;
use yii\web\Session;
use yii\web\User;

/**
 * 通过网络发送日志给 Fluentd 实例
 */
class FluentTarget extends Target
{
    /**
     * @var string
     */
    public $host;

    /**
     * @var string
     */
    public $port;

    public $logVars = [
        '_GET',
        '_POST',
        '_FILES',
        '_COOKIE',
        '_SESSION',
    ];

    /**
     * @var FluentLogger
     */
    private $logger;

    public function init()
    {
        parent::init();
    }

    public function export()
    {
        foreach ($this->messages as $message) {
            $this->getFluentLogger()->post('app', $this->formatMessage($message));
        }
    }

    public function formatMessage($message)
    {
        list($text, $level, $category, $timestamp) = $message;

        $level = Logger::getLevelName($level);

        $data = null;
        if (!is_string($text)) {
            if ($text instanceof \Throwable || $text instanceof \Exception) {
                $data = explode("\n", $text->getTraceAsString());
                $text = $text->getMessage();
            } else {
                $data = $text;
            }
        }

        $remoteIp = null;
        $userId = null;
        $sessionId = null;

        if (null !== Yii::$app) {
            $request = Yii::$app->getRequest();
            $remoteIp = $request instanceof Request ? $request->getUserIP() : null;

            $userId = null;
            /* @var $userCompo User */
            $userCompo = Yii::$app->has('user', true) ? Yii::$app->get('user') : null;
            if ($userCompo && ($user = $userCompo->getIdentity(false))) {
                $userId = $user->getId();
            }

            /* @var $session Session */
            $session = Yii::$app->has('session', true) ? Yii::$app->get('session') : null;
            $sessionId = $session && $session->getIsActive() ? $session->getId() : null;
        }

        return [
            'time' => date('Y-m-d H:i:s'),
            'level' => $level,
            'message' => $text,
            'data' => $data,
            'appId' => substr(Yii::$app->id, 0, 60),
            'category' => substr($category, 0, 200),
            'userId' => $userId,
            'sessionId' => $sessionId,
            'remoteIp' => $remoteIp,
        ];
    }

    /**
     * @return FluentLogger
     */
    private function getFluentLogger()
    {
        if (null === $this->logger) {
            $this->logger = new FluentLogger($this->host, $this->port);
        }

        return $this->logger;
    }
}
