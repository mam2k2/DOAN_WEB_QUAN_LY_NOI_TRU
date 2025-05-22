<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',//application id,must be unique
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'timeZone' => 'Asia/Ho_Chi_Minh',//@see \yii\base\Application::setTimeZone()
    'bootstrap' => ['log', 'inertia'],
    'language' => 'vi',
    'modules' => [
        'v2' => [
            'class' => 'backend\modules\v2\Module',
        ],
        'treemanager' => [
            'class' => '\kartik\tree\Module',
        ]
    ],
    'components' => [
        'inertia' => [
            'class' => 'tebe\inertia\Inertia',
            'assetsDirs' => [
                '@webroot/static/inertia'
            ]
        ],
        'user' => [
            'identityClass' => common\models\AdminUser::className(),
            'enableAutoLogin' => false,
            'identityCookie' => [
                'name' => '_backend_identity',
                'path' => '/admin',
            ],
            'idParam' => '__backend__id',
            'returnUrlParam' => '_backend_returnUrl',
        ],
        'session' => [
            'name' => 'BACKEND_FEEHICMS',
            'timeout' => 1440,//session expiration, unit: seconds. session过期时间，单位为秒
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    //when triggers {levels} level log, will write to file
                    'class' => yii\log\FileTarget::className(),
                    'levels' => ['error', 'warning'],
                    'logFile' => '@runtime/logs/'.date('Y/m/d') . '.log',
                ],
                [
                    /*
                        when occurs {levels} level error, will send you a email to {message.to} (当触发levels配置的错误级别时，发送到{message.to}配置的邮箱中)

                        Attention(特别注意): If you no need error message send to email, remove this configuration  (如您不需要发送邮件提醒建议删除此配置)

                        1. If enabled send log to email, ensure the correct SMTP configuration. or may, when a page occurs {levels} level log, they will response html after success send email or until connect to SMTP server timeout.
                        2. If common/config/main.php mail.useFileTransport is true, they will no send email. just write email to runtime directory, may exhaust hard disk
                        1.当打开的页面包含错误时，会等到发完邮件才响应html。若配置的SMTP地址有误，将会一直等待连接SMTP服务器超时后才响应。
                        2.如果common/config/main.php mail.useFileTransport为true时，并不会真发邮件，只把邮件写到runtime目录，很容易造成几十个G吃硬盘。
                     */
                    'class' => yii\log\EmailTarget::className(),
                    'levels' => ['error', 'warning'],
                    /*
                        default match all. if enabled categories, only config below rules will trigger send email notification.
                        默认匹配所有分类。启用此项后，仅匹配数组中的分类信息会触发邮件提醒（白名单）
                     */
                    /*'categories' => [
                        'yii\db\*',
                        'yii\web\HttpException:*',
                    ],*/
                    'except' => [//[black list] below exception will not treat as error (以下配置，除了匹配数组中的分类信息都会触发邮件提醒 [黑名单] )
                        'yii\web\HttpException:404',
                        'yii\web\HttpException:403',
                        'yii\debug\Module::checkAccess',
                    ],
                    'message' => [
                        'to' => ['alert1@xxx.com', 'alert2@xxx.com'],//your receive error log email addresses
                        'subject' => '来自 Feehi CMS 后台的新日志消息',
                    ],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'request' => [
            'cookieValidationKey' => '<cookie_validation_key>',
            'enableCsrfValidation' => false,
            'enableCsrfCookie' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'urlManager' => [
            /*
                - true url like xxx.com/controller/action (need your website enable url rewrite, more see http://doc.feehi.com/install.html)
                - false url like xxx.com/index.php?r=controller/action

                - true url格式如xxx.com/controller/action  (需要配合web服务器配置伪静态，详见http://doc.feehi.com/install.html)
                - false url格式如xxx.com/index.php?r=controller/action
             */
            'enablePrettyUrl' => false,
            'showScriptName' => true,
            'enableStrictParsing' => false,
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => yii\i18n\PhpMessageSource::className(),
                    'basePath' => '@backend/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
                'menu' => [
                    'class' => yii\i18n\PhpMessageSource::className(),
                    'basePath' => '@backend/messages',
                    'sourceLanguage' => 'zh-CN',
                    'fileMap' => [
                        'app' => 'menu.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'assetManager' => [
            'bundles' => [
                backend\assets\AppAsset::className() => [
                    'sourcePath' => '@backend/web/static',
                    'css' => [
                        'a' => 'css/bootstrap.min14ed.css?v=3.3.6',
                        'b' => 'css/font-awesome.min93e3.css?v=4.4.0',
                        'c' => 'css/animate.min.css',
                        'd' => 'css/style.min862f.css?v=4.1.0',
                        'f' => 'js/plugins/layer/laydate/theme/default/laydate.css',
                        'g' => 'css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css',
                        'h' => 'css/plugins/toastr/toastr.min.css',
                        'i' => 'css/plugins/chosen/chosen.css',
                        'j' =>'vuexy/vendor/fonts/tabler-icons.css',
                        'k' =>'vuexy/vendor/fonts/flag-icons.css',
                        'l' =>'vuexy/vendor/css/rtl/core.css',
                        'm'=>'vuexy/vendor/css/rtl/theme-default.css',
                        'n'=>'vuexy/vendor/css/pages/page-auth.css',
                        'o' => 'css/feehi.css',

                    ],
                    'js' => [
                        'a' => 'js/feehi.js',
                        'b' => 'js/plugins/layer/laydate/laydate.js',
                        'c' => 'js/plugins/layer/layer.min.js',
                        'd' => 'js/plugins/prettyfile/bootstrap-prettyfile.js',
                        'e' => 'js/plugins/toastr/toastr.min.js',
                        'f' => 'js/plugins/chosen/chosen.jquery.js',
                        'g' => 'vuexy/vendor/js/bootstrap.js',
                    ],
                ],
                backend\assets\IndexAsset::className() => [
                    'sourcePath' => '@backend/web/static',
                    'css' => [
                        'a' => 'css/bootstrap.min.css',
                        'b' => 'css/font-awesome.min93e3.css?v=4.4.0',
                        'c' =>'vuexy/vendor/fonts/tabler-icons.css',
                        'd' =>'vuexy/vendor/fonts/flag-icons.css',
                        'e' =>'vuexy/vendor/css/rtl/core.css',
                        'f'=>'vuexy/vendor/css/rtl/theme-default.css',
                        'g' => 'css/style.min862f.css?v=4.1.0',
                    ],
                    'js' => [
                        "a" => "vuexy/vendor/js/helpers.js",
                        'b' => "js/jquery.min.js?v=2.1.4",
                        //'b' => "js/bootstrap.min.js?v=3.3.6",
                        'c' => 'vuexy/vendor/js/bootstrap.js',
                        'd' => "js/plugins/metisMenu/jquery.metisMenu.js",
                        'e' => "js/plugins/slimscroll/jquery.slimscroll.min.js",
                        'f' => "js/plugins/layer/layer.min.js",
                        'g' => "js/hplus.min.js?v=4.1.0",
                        'h' => "js/contabs.min.js",
                        'i' => "js/plugins/pace/pace.min.js",
                        'j' => "vuexy/vendor/libs/hammer/hammer.js",
                        'k' => "vuexy/vendor/libs/popper/popper.js",
                        'l' => "vuexy/vendor/libs/perfect-scrollbar/perfect-scrollbar.js",
                        'm' => 'vuexy/vendor/node-waves/node-waves.js',
                        'n' => "vuexy/vendor/js/menu.js",
                        'o' => "vuexy/js/main.js",
                    ]
                ],
                backend\assets\UeditorAsset::className() => [
                    'sourcePath' => '@backend/web/static/js/plugins/ueditor',
                    'css' => [
                        'a' => 'ueditor.all.min.js'
                    ],
                ],
            ]
        ],
    ],
    'on beforeRequest' => [common\components\Feehi::className(), 'backendInit'],
    'as access' => [
        'class' => backend\components\AccessControl::className(),
        'allowActions' => [
            'site/login',
            'site/captcha',
            'site/error',
            'site/index',
            'site/main',
            'site/logout',
            'site/language',
            'admin-user/request-password-reset',
            'admin-user/reset-password',
            'admin-user/self-update',
            'assets/*',
            'debug/*',
            'gii/*',
            'v2/default/login',
        ],
        //super admin user id array, own whole permissions. 超级管理员用户id，拥有所有权限，不受权限管理的控制
        'superAdminUserIds' => [1],
    ],
    'params' => $params,
];
