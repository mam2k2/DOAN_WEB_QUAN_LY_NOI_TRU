<?php
namespace console\controllers;
use common\services\OrderServiceInterface;
use Yii;
use yii\console\Controller;

class OrderController extends Controller{
    public function actionReceivedOrders(){
        $transaction = Yii::$app->db->beginTransaction();
        try {
            /** @var $orderService OrderServiceInterface */
            $orderService = Yii::$app->get(OrderServiceInterface::ServiceName);
            $orders = $orderService->getOrdersReceive();
            foreach ($orders as $order){
                $orderService->handleOrderReceived($order->id);
            }
            $transaction->commit();
            return true;
        }catch (\Exception $e){
            $transaction->rollBack();
            echo $e->getMessage();
        }
    }

    public function actionResellOrders(){
        $transaction = Yii::$app->db->beginTransaction();
        try {
            /** @var $orderService OrderServiceInterface */
            $orderService = Yii::$app->get(OrderServiceInterface::ServiceName);
            $orders = $orderService->getPendingResellOrders();
            foreach ($orders as $order){
                $orderService->handleOrderSold($order->id);
            }
            $transaction->commit();
            return true;
        }catch (\Exception $e){
            $transaction->rollBack();
            echo $e->getMessage();
        }
    }
}