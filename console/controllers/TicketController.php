<?php
namespace console\controllers;

use common\services\UnitTransactionServiceInterface;
use common\services\UserServiceInterface;
use Yii;
use yii\console\Controller;

class TicketController extends Controller{
    public function actionHandleReward(){
        $transaction = Yii::$app->db->beginTransaction();
        try {
            /** @var $userService UserServiceInterface */
            $userService = Yii::$app->get(UserServiceInterface::ServiceName);
            /** @var $unitTransactionService UnitTransactionServiceInterface */
            $unitTransactionService = Yii::$app->get(UnitTransactionServiceInterface::ServiceName);
            $members = $userService->getAllUserIdsIsNotRewards();
            foreach ($members as $key => $ids) {
                $count = count($ids);
                $numOfRewards = floor($count / 3);
                if($numOfRewards == 0) continue;
                for ($i = 0; $i < $numOfRewards; $i++) {
                    $k = $i * 3;
                    $items = [];
                    while (count($items) < 3) {
                        if (!isset($ids[$k])) {
                            break;
                        }
                        $items[] = $ids[$k];
                        $k++;
                    }
                    if (count($items) > 0) {
                        $unitTransactionService->handleRewardTicket($key, $items);
                    }
                }
            }
            $transaction->commit();
        }catch (\Exception $e){
            $transaction->rollBack();
            echo $e->getTraceAsString();
        }
    }
}