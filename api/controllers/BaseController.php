<?php

namespace api\controllers;

use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\web\Response;

class BaseController extends ActiveController
{
    public $serializer = [
        'class' => 'api\components\Serializer',
        'collectionEnvelope' => 'list'
    ];

    public $enableCsrfValidation = false;
    public $optionals = [];
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(),
            [
            'authenticator' => [
                //使用ComopositeAuth混合认证
                'class' => CompositeAuth::className(),
                'optional' => $this->optionals,
                'authMethods' => [
                    HttpBasicAuth::className(),
                    HttpBearerAuth::className(),
                    [
                        'class' => QueryParamAuth::className(),
                        'tokenParam' => 'access-token',
                    ]
                ]
            ],
        ]);
    }
}