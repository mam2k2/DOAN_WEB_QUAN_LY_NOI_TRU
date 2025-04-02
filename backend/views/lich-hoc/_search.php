<?php

use yii\helpers\Html;
use backend\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\search\LichHocSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lich-hoc-search ibox-heading row search" style="margin-top: 5px;padding-top:5px">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['options'=>['class'=>'col-sm-3']]) ?>

    <?= $form->field($model, 'mon_id', ['options'=>['class'=>'col-sm-3']]) ?>

    <?= $form->field($model, 'thu_trong_tuan', ['options'=>['class'=>'col-sm-3']]) ?>

    <?= $form->field($model, 'tiet', ['options'=>['class'=>'col-sm-3']]) ?>

    <?= $form->field($model, 'thoi_gian_bat_dau', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'thoi_gian_ket_thuc', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'ghi_chu', ['options'=>['class'=>'col-sm-3']]) ?>

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
