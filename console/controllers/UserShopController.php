<?php
namespace console\controllers;
use common\services\OrderServiceInterface;
use common\services\UserShopServiceInterface;
use Yii;
use yii\console\Controller;

class UserShopController extends Controller{
    public function actionHandleActiveShop(){
        $transaction = Yii::$app->db->beginTransaction();
        try {
            /** @var $userShopService UserShopServiceInterface */
            $userShopService = Yii::$app->get(UserShopServiceInterface::ServiceName);
            $userShops = $userShopService->getPendingUserShops();
            foreach ($userShops as $userShop){
                $userShopService->handleStatusActive($userShop->user_id, $userShop->shop_id);
            }
            $transaction->commit();
            return true;
        }catch (\Exception $e){
            $transaction->rollBack();
            echo $e->getMessage();
        }
    }
}