<?php

namespace console\controllers;

use common\services\CasoHookServiceInterface;

class CassoHookController
{
    public function actionSyncTransaction()
    {
        /**
         * @var  $cassoHookService CasoHookServiceInterface
         */
        $cassoHookService = \Yii::$app->get(CasoHookServiceInterface::ServiceName);
        echo $cassoHookService->syncTransaction();
    }
}