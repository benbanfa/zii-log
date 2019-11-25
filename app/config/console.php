<?php

return [
    'controllerNamespace' => 'app\\commands',
    'controllerMap' => [
        'migrate' => [
            'class' => \yii\console\controllers\MigrateController::class,
            'migrationPath' => null,
            'migrationNamespaces' => [
            ],
        ],
    ],
];
