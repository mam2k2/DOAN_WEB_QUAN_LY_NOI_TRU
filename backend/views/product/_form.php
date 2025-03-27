<?php

use backend\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $branchOptions array */
/* @var $categoryOptions array */
/* @var $form backend\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?php $form = ActiveForm::begin([
                    'options' => [
                    ]
                ]); ?>
                <div class="hr-line-dashed"></div>


                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'branch_id')->chosenSelect($branchOptions) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'category_id')->chosenSelect($categoryOptions) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'price_import')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'price_export')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'tax_percentage')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'quantity')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'note')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'desc')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'type')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'SKU')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'unit')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'status')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->defaultButtons() ?>
                    <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>