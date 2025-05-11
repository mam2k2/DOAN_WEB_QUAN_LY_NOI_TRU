<?php

use yii\helpers\Html;
use backend\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\search\KhuKtxSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="khu-ktx-search ibox-heading row search" style="margin-top: 5px;padding-top:5px">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['options'=>['class'=>'col-sm-3']])->label("ID") ?>

    <?= $form->field($model, 'ma_khu', ['options'=>['class'=>'col-sm-3']])->label("Mã khu") ?>

    <?= $form->field($model, 'ten_khu', ['options'=>['class'=>'col-sm-3']])->label("Tên khu") ?>

    <?= $form->field($model, 'vi_tri', ['options'=>['class'=>'col-sm-3']])->label("Vị trí") ?>

    <?= $form->field($model, 'ghi_chu', ['options'=>['class'=>'col-sm-3']])->label("Ghi chú") ?>

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
