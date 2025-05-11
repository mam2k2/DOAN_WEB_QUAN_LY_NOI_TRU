<?php

use backend\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\KhuKtx */
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
                    <?= $form->field($model, 'ma_khu')->textInput(['maxlength' => true])->label("Mã khu") ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'ten_khu')->textInput(['maxlength' => true])->label("Tên khu") ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'vi_tri')->textInput(['maxlength' => true])->label("Vị trí") ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 6])->label("Ghi chú") ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->defaultButtons() ?>
                    <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>