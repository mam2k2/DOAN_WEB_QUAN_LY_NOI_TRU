<?php
namespace console\controllers;
use common\models\BalanceVolatility;
use common\models\Order;
use common\models\UnitTransaction;
use common\models\User;
use common\models\UserShop;
use common\models\UserTransaction;
use common\services\OrderServiceInterface;
use common\services\UserServiceInterface;
use common\services\UserShopServiceInterface;
use Yii;
use yii\console\Controller;

class DataController extends Controller{
    public function actionDeleteTestUserData(){
        $userIds = [24, 32, 33, 34, 35, 38, 39, 40];
        $transaction = Yii::$app->db->beginTransaction();
        try {
            foreach ($userIds as $userId){
                /** @var $userService UserServiceInterface */
                $userService = Yii::$app->get(UserServiceInterface::ServiceName);
                /** @var $user User */
                $user = $userService->getDetail($userId);
                $user->withdrawal_wallet = 0;
                $user->recharge_wallet = 0;
                $user->num_of_nft = 0;
                $user->num_of_point = 0;
                $user->num_of_ticket = 0;
                $user->save();
                Order::deleteAll(['user_id' => $userId]);
                UnitTransaction::deleteAll(['user_id' => $userId]);
                BalanceVolatility::deleteAll(['user_id' => $userId]);
                UserShop::deleteAll(['user_id' => $userId]);
                UserTransaction::deleteAll(['user_id' => $userId]);
            }
            $transaction->commit();
            return true;
        }catch (\Exception $e){
            $transaction->rollBack();
            echo $e->getMessage();
        }
    }

    public function actionCreateSalesFakeData(){
        $data = [
            [
                "user" => 32,
                "deposit" => 10000000,
                "product" => 9,
                "round" => 17
            ],
            [
                "user" => 33,
                "deposit" => 10000000,
                "product" => 10,
                "round" => 16
            ],
            [
                "user" => 34,
                "deposit" => 10000000,
                "product" => 8,
                "round" => 16
            ],
            [
                "user" => 35,
                "deposit" => 10000000,
                "product" => 9,
                "round" => 16
            ],
            [
                "user" => 38,
                "deposit" => 10000000,
                "product" => 8,
                "round" => 32
            ],
            [
                "user" => 39,
                "deposit" => 10000000,
                "product" => 9,
                "round" => 16
            ],
            [
                "user" => 40,
                "deposit" => 10000000,
                "product" => 9,
                "round" => 48
            ],
        ];
        $transactionCtrl = new TransactionController('transaction',\Yii::$app);
        $transaction = Yii::$app->db->beginTransaction();
        try {
            foreach ($data as $item){
                $transactionCtrl->actionRecharge($item['user'], $item['deposit']);
                $userTransaction = UserTransaction::find()->where(['user_id' => $item['user'],
                    'status' => UserTransaction::STATUS_PENDING,
                    'type' => UserTransaction::TYPE_DEPOSIT])->orderBy(['created_at' => SORT_DESC])->one();
                if(!is_null($userTransaction)){
                    $transactionCtrl->actionConfirmRecharge($userTransaction->code, $item['deposit']);
                   $transactionCtrl->actionBuyProductsInRounds($item['user'], $item['product'], $item['round']);
                }
            }
            $transaction->commit();
        }catch (\Exception $e){
            echo $e->getMessage();
            $transaction->rollBack();
        }
    }
}