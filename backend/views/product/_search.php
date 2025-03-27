<?php

use yii\helpers\Html;
use backend\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\search\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search ibox-heading row search" style="margin-top: 5px;padding-top:5px">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['options'=>['class'=>'col-sm-3']]) ?>

    <?= $form->field($model, 'category_id', ['options'=>['class'=>'col-sm-3']]) ?>

    <?= $form->field($model, 'name', ['options'=>['class'=>'col-sm-3']]) ?>

    <?= $form->field($model, 'branch_id', ['options'=>['class'=>'col-sm-3']]) ?>

    <?= $form->field($model, 'price_import', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'price_export', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'tax_percentage', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'quantity', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'note', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'desc', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'type', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'SKU', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'unit', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'status', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'created_by', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'updated_by', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'deleted_by', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'created_at', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'updated_at', ['options'=>['class'=>'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'deleted_at', ['options'=>['class'=>'col-sm-3']]) ?>

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
