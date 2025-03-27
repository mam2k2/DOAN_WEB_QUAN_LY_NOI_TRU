<?php
namespace console\controllers;

use common\models\Product;
use common\models\BalanceVolatility;
use common\models\BankAccount;
use common\models\CasoHook;
use common\models\Category;
use common\models\Comment;
use common\models\Notification;
use common\models\Order;
use common\models\PromotionProposal;
use common\models\Shop;
use common\models\UnitTransaction;
use common\models\User;
use common\models\UserIdentity;
use common\models\UserShop;
use common\models\UserTransaction;
use common\services\UnitTransactionServiceInterface;
use common\services\UserServiceInterface;
use Yii;
use yii\console\Controller;

class DbController extends Controller{
    public function actionReset(){
        $transaction = Yii::$app->db->beginTransaction();
        try {
            BankAccount::deleteAll();
            CasoHook::deleteAll();
            BalanceVolatility::deleteAll();
            Category::deleteAll();
            Comment::deleteAll();
            Notification::deleteAll();
            PromotionProposal::deleteAll();
            UnitTransaction::deleteAll();
            UserIdentity::deleteAll();
            UserShop::deleteAll();
            UserTransaction::deleteAll();
            Product::deleteAll();
            Order::deleteAll();
            User::deleteAll();
        }catch (\Exception $e){
            $transaction->rollBack();
            echo $e->getTraceAsString();
        }
    }
}
?>