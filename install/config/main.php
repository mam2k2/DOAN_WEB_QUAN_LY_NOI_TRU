<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php')
);

$config = [
    'id' => 'app-install',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'install\controllers',
    'language' => 'zh-CN',
    'timeZone' => 'Asia/Shanghai',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'qxOH-LMMrJJ_unqJzWsPO1eL39JF0cnK',
            'csrfParam' =>'_csrf_install',
        ],
        'log' => [//此项具体详细配置，请访问http://wiki.feehi.com/index.php?title=Yii2_log
            'traceLevel' => 3,
            'targets' => [
                [
                    'class' => yii\log\FileTarget::className(),//当触发levels配置的错误级别时，保存到日志文件
                    'levels' => ['error', 'warning'],
                    'logFile' => '@runtime/logs/app.log',
                ]
            ],
        ],
        'i18n' => [
            'translations' => [
                'install*' => [
                    'class' => yii\i18n\PhpMessageSource::className(),
                    'basePath' => '@install/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'df' => 'install.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
    ],
    'params' => $params,
    'on beforeRequest' => function($event) {
        if(isset(\yii::$app->session['language'])) \yii::$app->language = yii::$app->session['language'];
    },
];
if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => yii\debug\Module::className(),
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => yii\gii\Module::className(),
    ];
}
return $config;
