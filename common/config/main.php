<?php
return [
    'name' => 'Yii2 Core',
    'version' => '1.0.0',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => array_merge([
        /**
         * dsn:
         *  - mysql mysql:host=localhost;dbname=feehi
         *  - sqlite sqlite:/feehi.db
         */
//        'db' => [//database config, will be covered by backend|frontend|api]/main-[local].php
//            'class' => yii\db\Connection::className(),
//            'dsn' => 'sqlite:/feehi.db',
//            'username' => '',
//            'password' => '',
//            'charset' => '',
//        ],

        'response' => [
            'class' => common\components\Response::className(),
        ],
        'cdn' => [//support Qiniu(七牛) TencentCloud(腾讯云) Aliyun(阿里云) Netease(网易云) more detail for visit http://doc.feehi.com/cdn.html
            'class' => feehi\cdn\DummyTarget::className(),//DummyTarget will not use and cdn
        ],
        'cache' => [//cache component more detail for visit http://doc.feehi.com/configs.html
            'class' => yii\caching\FileCache::className(),//use file cache, also can replace with redis or other
        ],
        'formatter' => [//global display format configuration
            'dateFormat' => 'php:Y-m-d H:i',
            'datetimeFormat' => 'php:Y-m-d H:i:s',
            'decimalSeparator' => ',',
            'thousandSeparator' => '.',
            'currencyCode' => 'VND',
            'nullDisplay' => '-',
            'locale' => 'vi'
        ],
        'mailer' => [
            'class' => yii\swiftmailer\Mailer::className(),
            'viewPath' => '@common/mail',
            'useFileTransport' => true,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'tqnovel@gmail.com',
                'password' => 'qrbqbwvrwubgbrxi',
                'port' => '587',
                'encryption' => 'tls',
            ],
            'messageConfig' => [
                'charset' => 'UTF-8',
                'from' => ['tqnovel@gmail.com' => 'Feehi CMS robot ']
            ],
        ],
        'feehi' => [
            'class' => common\components\Feehi::className(),
        ],
        'authManager' => [
            'class' => yii\rbac\DbManager::className(),
        ],
        'assetManager' => [
            'linkAssets' => false,
            'bundles' => [
                yii\widgets\ActiveFormAsset::className() => [
                    'js' => [
                        'a' => 'yii.activeForm.js'
                    ],
                ],
                yii\bootstrap\BootstrapAsset::className() => [
                    'css' => [],
                    'sourcePath' => null,
                ],
                yii\captcha\CaptchaAsset::className() => [
                    'js' => [
                        'a' => 'yii.captcha.js'
                    ],
                ],
                yii\grid\GridViewAsset::className() => [
                    'js' => [
                        'a' => 'yii.gridView.js'
                    ],
                ],
                yii\web\JqueryAsset::className() => [
                    'js' => [
                        'a' => 'jquery.js'
                    ],
                ],
                yii\widgets\PjaxAsset::className() => [
                    'js' => [
                        'a' => 'jquery.pjax.js'
                    ],
                ],
                yii\web\YiiAsset::className() => [
                    'js' => [
                        'a' => 'yii.js'
                    ],
                ],
                yii\validators\ValidationAsset::className() => [
                    'js' => [
                        'a' => 'yii.validation.js'
                    ],
                ],
            ],
        ],
    ], require "services.php")
];