<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-03-21 18:46
 */

namespace backend\grid;

use Yii;
use yii\helpers\Html;

/**
 * @inheritdoc
 */
class RechargeWithdrawColumn extends DataColumn
{
    public $recharge = null;
    public $withdrawal = null;

    public $format = ["raw"];

    public function renderDataCellContent($model,$key,$index){
        $recharge = call_user_func($this->recharge, $model);
        $withdrawal = call_user_func($this->withdrawal, $model);
        $html = Html::tag('span', \Yii::t('app','Recharge').": ".Yii::$app->formatter->asDecimal($recharge));
        $html .= Html::tag("br");
        $html .= Html::tag("span", \Yii::t('app', 'Withdrawal').": ".Yii::$app->formatter->asDecimal($withdrawal));
        return $html;
    }
}