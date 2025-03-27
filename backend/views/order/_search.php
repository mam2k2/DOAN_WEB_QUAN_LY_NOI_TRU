<?php

use common\libs\Constants;
use common\models\Order;
use yii\helpers\Html;
use backend\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\search\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search ibox-heading row search" style="margin-top: 5px;padding-top:5px">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['options'=>['class'=>'col-sm-3']]) ?>

    <?= $form->field($model, 'shop_id', ['options'=>['class'=>'col-sm-3']])->chosenSelect($shopOptions) ?>

    <?= $form->field($model, 'user_id', ['options'=>['class'=>'col-sm-3']])->chosenSelect($userOptions) ?>

    <?= $form->field($model, 'name', ['options'=>['class'=>'col-sm-3']]) ?>

    <?= $form->field($model, 'category_id', ['options'=>['class'=>'col-sm-3']])->chosenSelect($categoryOptions) ?>

    <?php // echo $form->field($model, 'image', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'description', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'content', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php echo $form->field($model, 'status', ['options'=>['class'=>'col-sm-3']])->chosenSelect(Order::getStatusItems()) ?>

    <?php // echo $form->field($model, 'purchase_expiration', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'sales_expiration', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'address', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php echo $form->field($model, 'is_system', ['options'=>['class'=>'col-sm-3']])->dropDownList(Constants::getYesNoItems()) ?>

    <?php echo $form->field($model, 'type', ['options'=>['class'=>'col-sm-3']])->dropDownList(Order::getTypeItems()) ?>

    <?php // echo $form->field($model, 'created_by', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'updated_by', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'created_at', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'updated_at', ['options'=>['class'=>'col-sm-3']]) ?>

    <div class="col-sm-3">
        <div class="col-sm-6">
            <?= Html::submitButton(Yii::t("app", Yii::t('app', 'Search')), ['class' => 'btn btn-primary btn-block']) ?>
        </div>
        <div class="col-sm-6">
            <?= Html::a(Yii::t("app", Yii::t('app', 'Reset')), Url::to(['index']), ['class' => 'btn btn-default btn-block']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
