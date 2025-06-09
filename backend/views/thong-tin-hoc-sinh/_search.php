<?php

use yii\helpers\Html;
use backend\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\search\ThongTinHocSinhSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="thong-tin-hoc-sinh-search ibox-heading row search" style="margin-top: 5px;padding-top:5px">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['options'=>['class'=>'col-sm-3']]) ?>
    <div class="col-sm-3">
        <?=$form->field($model, 'que_quan')->widget(\kartik\select2\Select2::class, [
            'data' => $tinhThanhList,
            'options' => ['placeholder' => 'Trường THCS','class'=>'col-sm-3'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);?>
    </div>
    <div class="col-sm-3">
        <?=$form->field($model, 'truong_thcs')->widget(\kartik\select2\Select2::class, [
            'data' => $thcsList,
            'options' => ['placeholder' => 'Trường THCS','class'=>'col-sm-3'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);?>
    </div>
    <div class="col-sm-3">
        <?=$form->field($model, 'truong_thpt')->widget(\kartik\select2\Select2::class, [
            'data' => $thptList,
            'options' => ['placeholder' => 'Trường THPT','class'=>'col-sm-3'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);?>
    </div>


    <?php // echo $form->field($model, 'trang_thai', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'diem_trung_binh', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'ngay_bat_dau', ['options'=>['class'=>'col-sm-3']]) ?>

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
