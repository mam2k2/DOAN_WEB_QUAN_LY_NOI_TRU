<?php

use yii\helpers\Html;
use backend\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\search\ThuPhiNoiTruSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="thu-phi-noi-tru-search ibox-heading row search" style="margin-top: 5px;padding-top:5px">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['options'=>['class'=>'col-sm-3']]) ?>

<!--    --><?php //= $form->field($model, 'hoc_sinh_id', ['options'=>['class'=>'col-sm-3']]) ?>
<!---->
<!---->
<!--    --><?php //= $form->field($model, 'phong_id', ['options'=>['class'=>'col-sm-3']]) ?>
<!---->
<!--    --><?php //= $form->field($model, 'so_tien', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'ngay_thu', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'nguoi_thu', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'trang_thai', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'ghi_chu', ['options'=>['class'=>'col-sm-3']]) ?>

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
