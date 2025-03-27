<?php
namespace console\controllers;

use common\models\Order;
use common\models\UserTransaction;
use common\services\BalanceVolatilityServiceInterface;
use common\services\OrderServiceInterface;
use common\services\ProductServiceInterface;
use common\services\UnitTransactionService;
use common\services\UnitTransactionServiceInterface;
use common\services\UserServiceInterface;
use common\services\UserShopServiceInterface;
use common\services\UserTransactionServiceInterface;
use Yii;

class TransactionController extends \yii\console\Controller{
    /**
     * Nạp tiền
    * @param $userId
    * @param $amount
    * @return true
    * @throws \yii\base\InvalidConfigException
     */
    public function actionRecharge($userId, $amount){
        /** @var $userTransactionService UserTransactionServiceInterface */
        $userTransactionService = \Yii::$app->get(UserTransactionServiceInterface::ServiceName);
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $userTransactionService->recharge($userId, $amount);
            $transaction->commit();
            return true;
        }catch (\Exception $e){
            $transaction->rollBack();
            echo $e->getMessage();
        }
        return true;
    }

    public function actionConfirmRecharge($code, $amount){
        /** @var $userTransactionService UserTransactionServiceInterface */
        $userTransactionService = Yii::$app->get(UserTransactionServiceInterface::ServiceName);
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $userTransactionService->handleDoneTransaction($code, $amount);
            $transaction->commit();
            return true;
        }catch (\Exception $e){
            $transaction->rollBack();
            echo $e->getMessage();
        }
        return true;
    }

    public function actionBuyTicket($userId, $amount = 1){
        /** @var $unitTransactionService UnitTransactionServiceInterface */
        $unitTransactionService = Yii::$app->get(UnitTransactionServiceInterface::ServiceName);
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $unitTransactionService->buyTicket($userId, $amount);
            $transaction->commit();
            return true;
        }catch (\Exception $e){
            $transaction->rollBack();
            echo $e->getMessage();
        }
        return true;
    }

    public function actionUseTicket($userId, $shopId){
        /** @var $unitTransactionService UnitTransactionServiceInterface */
        $unitTransactionService = Yii::$app->get(UnitTransactionServiceInterface::ServiceName);
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $unitTransactionService->handleTicketUsed($userId, $shopId);
            $transaction->commit();
            return true;
        }catch (\Exception $e){
            $transaction->rollBack();
            echo $e->getMessage();
        }
        return true;
    }

    public function actionBuyProduct($userId, $productId){
        /** @var $orderService OrderServiceInterface */
        $orderService = Yii::$app->get(OrderServiceInterface::ServiceName);
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $orderService->createOrderNormal($userId, $productId, 'Hải Phòng');
            $transaction->commit();
            return true;
        }catch (\Exception $e){
            $transaction->rollBack();
            echo $e->getMessage();
        }
        return true;
    }

    public function actionSellProduct($orderId){
        /** @var $orderService OrderServiceInterface */
        $orderService = Yii::$app->get(OrderServiceInterface::ServiceName);
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $orderService->sellOrderNormal($orderId);
            $transaction->commit();
            return true;
        }catch (\Exception $e){
            $transaction->rollBack();
            echo $e->getMessage();
        }
        return true;
    }

    public function actionTakeProduct($orderId){
        /** @var $orderService OrderServiceInterface */
        $orderService = Yii::$app->get(OrderServiceInterface::ServiceName);
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $orderService->takeOrderNormal($orderId);
            $transaction->commit();
            return true;
        }catch (\Exception $e){
            $transaction->rollBack();
            echo $e->getMessage();
        }
        return true;
    }

    public function actionWithdrawal($userId, $amount){
        /** @var $userService UserServiceInterface  */
        $userService = Yii::$app->get(UserServiceInterface::ServiceName);
        /** @var $userTransactionService UserTransactionServiceInterface */
        $userTransactionService = Yii::$app->get(UserTransactionServiceInterface::ServiceName);
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $user = $userService->getDetail($userId);
            $userTransactionService->withdraw($user->id, $amount);
            $transaction->commit();
            return true;
        }catch (\Exception $e){
            $transaction->rollBack();
            echo $e->getMessage();
        }
        return true;
    }

    public function actionTest($userId){
        echo Order::getNumOfSalesRoundByUser($userId);
    }

    public function actionBuyProductsInRounds($userId, $productId, $round = 15){
        $transaction = Yii::$app->db->beginTransaction();
        $userShopCtrl = new UserShopController('user-shop',\Yii::$app);
        $orderCtrl = new OrderController('order',\Yii::$app);
        try{
            /** @var $productService ProductServiceInterface */
            $productService = Yii::$app->get(ProductServiceInterface::ServiceName);
            $product = $productService->getDetail($productId);
            $shop = $product->shop;
            for ($i = 0; $i < $round; $i++){
                $this->actionBuyTicket($userId, 1);
                $this->actionUseTicket($userId, $shop->id);
                $userShopCtrl->actionHandleActiveShop();
                $this->actionBuyProduct($userId, $product->id);
                $orderCtrl->actionReceivedOrders();
                $order = Order::find()->where(['user_id' => $userId, 'product_id' => $productId])
                    ->andWhere(['type' => Order::TYPE_NONE, 'status' => Order::STATUS_NONE])->one();
                $this->actionSellProduct($order->id);
                $orderCtrl->actionResellOrders();
            }
            $transaction->commit();
        }catch (\Exception $e){
            $transaction->rollBack();
            echo $e->getMessage();
        }
        return true;
    }
}