<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic-fo-simtb',
    'name' => 'Sistem Informasi Alumni',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone' => 'Asia/Jakarta',
    //'homeUrl' => '/siregPlus/backoffice',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'simtb-fo-unand-oORmoUKQltir6QyaKRw1_hm_r8Orl-gD_tqwert54228bkJhgHuiOWrTtyUiOo99877',
        //'baseUrl' => '/siregPlus/backoffice',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'viewPath' => '@app/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.office365.com',
                'username' => 'noreply@lptik.unand.ac.id',
                'password' => 'Iam4dmin',
                'port' => 587,
                'encryption' => 'tls',
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                    [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'session' => [
            'class' => 'yii\web\DbSession',
            // Set the following if you want to use DB component other than default 'db'.
            'db' => 'db',
            // To override default session table, set the following
            'sessionTable' => 'app_session',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                '<action>' => 'site/<action>',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>'
            ],
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'currencyCode' => '',
        ],
        'terbilang' => [
            'class' => 'app\components\Terbilang',
        ],
        'versionApp' => [
            'class' => 'app\components\AppVersion'
        ],
    ],
    'params' => $params,
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
        'mahasiswa' => [
            'class' => 'app\modules\mahasiswa\Module',
        ],
        'pendaftaran' => [
            'class' => 'app\modules\pendaftaran\Module',
        ],
        'daftar' => [
            'class' => 'app\modules\daftar\Module',
        ],
    ]
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
            // uncomment the following to add your IP if you are not connecting from localhost.
            //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
            // uncomment the following to add your IP if you are not connecting from localhost.
            //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
