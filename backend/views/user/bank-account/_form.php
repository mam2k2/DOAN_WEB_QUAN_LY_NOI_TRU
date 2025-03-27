<?php

use backend\widgets\ActiveForm;
use backend\widgets\ColumnsWidget;
use common\libs\Constants;

/* @var $this yii\web\View */
/* @var $model common\models\BankAccount */
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
                <?=ColumnsWidget::widget(['columns' => [6, 6], 'columnLabels' => [
                    $form->field($model, 'name')->textInput(['maxlength' => true]),
                    $form->field($model, 'bank_name')->textInput(['maxlength' => true]),
                    $form->field($model, 'bank_number')->textInput(['maxlength' => true]),
                    $form->field($model, 'qr_image')->imgInput(),
                    $form->field($model, 'active')->radioList(Constants::getYesNoItems()),
                    $form->field($model, 'default')->radioList(Constants::getYesNoItems())
                ]])?>
                <?=$form->field($model,'user_id')->hiddenInput()->label(false) ?>
                        <?= $form->defaultButtons() ?>
                    <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>