<?php
namespace console\controllers;

use common\models\BalanceVolatility;
use common\services\BalanceVolatilityServiceInterface;
use Yii;
use yii\console\Controller;

class BalanceVolatilityController extends Controller{
    public function actionDeleteBalance($toId){
        $transaction = Yii::$app->db->beginTransaction();
        try {
            /** @var $balanceService BalanceVolatilityServiceInterface */
            $balanceService = Yii::$app->get(BalanceVolatilityServiceInterface::ServiceName);
            $balance = $balanceService->getDetail($toId);
            $balances = BalanceVolatility::find()->where(['>=','id',$toId])
                ->andWhere(['user_id' => $balance->user_id])->all();
            foreach ($balances as $balanceItem){
                $balanceItem->delete();
            }
            $transaction->commit();
        }catch (\Exception $e){
            $transaction->rollBack();
            echo $e->getTraceAsString();
        }
    }
}