<?php

namespace console\controllers;

use common\libs\Constants;
use common\services\BalanceVolatilityServiceInterface;
use common\services\UnitTransactionServiceInterface;
use common\services\UserServiceInterface;
use common\models\User;
use Yii;

class MonthlySalesController extends \yii\console\Controller
{
    public function actionIndex()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            /** @var $unitTransactionService UnitTransactionServiceInterface */
            $unitTransactionService = \Yii::$app->get(UnitTransactionServiceInterface::ServiceName);
            /** @var $balanceVolatilityService BalanceVolatilityServiceInterface */
            $balanceVolatilityService = \Yii::$app->get(BalanceVolatilityServiceInterface::ServiceName);
            /** @var $userService UserServiceInterface */
            $userService = \Yii::$app->get(UserServiceInterface::ServiceName);
            $month = date('m');
            $year = date('Y');
            $monthlySales = $unitTransactionService->calcMonthlySales($month, $year);
            /* Các thành viên là công ty */
            $userRootIds = [];
            foreach ($monthlySales as $userId => $monthlySale) {
                /** @var User $user */
                $user = $userService->getDetail($userId);
                if ($user->level != Constants::USER_LEVEL_ROOT) {
                    $balanceVolatilityService->receiveTicketCommissionMonth($userId, $month, $year);
                    $balanceVolatilityService->receiveNFTCommissionMonth($userId, $month, $year);
                } else {
                    $userRootIds[] = $userId;
                }
            }
            foreach ($userRootIds as $userRootId) {
                $balanceVolatilityService->receiveTicketCommissionMonth($userRootId, $month, $year);
                $balanceVolatilityService->receiveNFTCommissionMonth($userRootId, $month, $year);
            }
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            echo $e->getTraceAsString();
        }
        return true;
    }

    public function actionCalcMonthlyCommission($userId, $month = null, $year = null)
    {
        /** @var $userService UserServiceInterface */
        $userService = \Yii::$app->get(UserServiceInterface::ServiceName);
        /** @var User $user */
        $user = $userService->getDetail(24);
        if(is_null($month))
            $month = date('m');
        if(is_null($year))
            $year = date('Y');
        $transaction = Yii::$app->db->beginTransaction();
        try {
            /** @var $balanceVolatilityService BalanceVolatilityServiceInterface */
            $balanceVolatilityService->receiveTicketCommissionMonth($userId, $month, $year);
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            echo $e->getMessage();
        }
        return true;
    }
}