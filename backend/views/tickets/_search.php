<?php

use yii\helpers\Html;
use backend\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\search\TicketsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tickets-search ibox-heading row search" style="margin-top: 5px;padding-top:5px">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['options'=>['class'=>'col-sm-3']]) ?>

<!--    --><?php //= $form->field($model, 'tieu_de', ['options'=>['class'=>'col-sm-3']]) ?>
<!---->
<!--    --><?php //= $form->field($model, 'noi_dung', ['options'=>['class'=>'col-sm-3']]) ?>
<!---->
<!--    --><?php //= $form->field($model, 'danh_muc', ['options'=>['class'=>'col-sm-3']]) ?>
<!---->
<!--    --><?php //= $form->field($model, 'trang_thai', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'do_khan_cap', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'user_id', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'assigned_to', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'created_at', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'updated_at', ['options'=>['class'=>'col-sm-3']]) ?>

    <div class="col-sm-3">
        <div class="col-sm-6">
            <?= Html::submitButton(Yii::t("app", 'Search'), ['class' => 'btn btn-primary btn-block']) ?>
        </div>
        <div class="col-sm-6">
            <?= Html::a(Yii::t("app", 'Reset'), Url::to(['index']), ['class' => 'btn btn-default btn-block']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
