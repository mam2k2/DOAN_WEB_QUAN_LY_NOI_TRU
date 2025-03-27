<?php

namespace backend\controllers;

use backend\actions\IndexAction;
use common\services\MonthlySaleServiceInterface;
use common\services\UserServiceInterface;
use Yii;

class MonthlySaleController extends \yii\web\Controller
{
    public function actions()
    {
        /** @var $service MonthlySaleServiceInterface */
        $service = Yii::$app->get(MonthlySaleServiceInterface::ServiceName);
        /** @var $userService UserServiceInterface */
        $userService = Yii::$app->get(UserServiceInterface::ServiceName);
        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function(array $query) use ($service, $userService){
                    $result = $service->getList($query);
                    $data = [
                        'dataProvider' => $result['dataProvider'],
                        'searchModel' => $result['searchModel'],
                        'userOptions' => $userService->getUserOptions(),
                    ];
                    return $data;
                }
            ]
        ];
    }
}