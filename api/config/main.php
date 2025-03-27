<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php')
);

return [
    'id' => 'api',
    'name'=>'Vody App',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'vi',
    'controllerNamespace' => 'api\controllers',
    'components' => array_merge([
        'user' => [
            'class' => yii\web\User::class,
            'identityClass' => api\models\AdminUser::class,
            'enableSession' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                    'logFile' => '@runtime/logs/'.date('Y/m/d') . '.log',
                ],
                [
                    'class' => yii\log\EmailTarget::class,
                    'levels' => ['error', 'warning'],
                    /*'categories' => [
                        'yii\db\*',
                        'yii\web\HttpException:*',
                    ],*/
                    'except' => [
                        'yii\web\HttpException:404',
                        'yii\web\HttpException:403',
                        'yii\debug\Module::checkAccess',
                    ],
                    'message' => [
                        'to' => ['alert1@xxx.com', 'alert2@xxx.com'],
                        'subject' => '来自 Feehi CMS api的新日志消息',
                    ],
                ],
            ],
        ],
        'cache' => [
            'class' => yii\caching\DummyCache::class,
            'keyPrefix' => 'api',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                'login' => 'site/login',
                'v1/login' => 'v1/site/login',
                'forgot-password' => 'site/forgot-password',
                'v1/forgot-password' => 'v1/site/forgot-password',
                'send-mail' => 'site/send-mail',
                'v1/send-mail' => 'v1/site/send-mail',
                'register' => 'site/register',
                'load-data' => 'site/load-data',
                [
                    'class' => yii\rest\UrlRule::class,
                    /*
                        request url like /users,/user/1,/paid/info

                        通过/users,/user/1,/paid/info访问
                     */
                    'controller' => [
                        'admin-user',
                    ]
                    /*'extraPatterns' => [
                        'GET search' => 'search',
                    ],*/
                ],
                [
                    'class' => yii\rest\UrlRule::class,
                    /*
                        API version 1, request url like /v1/users,/v1/user/1 ...

                        v1版本路由，通过/v1/users,/v1/user/1 ...访问
                     */
                    'controller' => [
                        'admin-user',
                    ],
                ],
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                '<version:v\d+>/<controller:\w+>/<action:\w+>'=>'<version>/<controller>/<action>',
            ],
        ],
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
                'text/json' => 'yii\web\JsonParser',
            ],
            'enableCsrfValidation' => false,
            'enableCookieValidation' => false,
        ],
        'response' => [
            'format' => null,
            'as format' => [
                'class' => api\behaviors\ResponseFormatBehavior::class,
            ]
        ],
    ], require "services.php"),
    'modules' => [
        'v1' => [
            'class' => api\modules\v1\Module::class,
        ],
    ],
    'params' => $params,
];
