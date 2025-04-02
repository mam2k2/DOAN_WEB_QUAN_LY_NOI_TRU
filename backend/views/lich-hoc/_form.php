<?php

use backend\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LichHoc */
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
                    <?= $form->field($model, 'mon_id')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'thu_trong_tuan')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'tiet')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'thoi_gian_bat_dau')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'thoi_gian_ket_thuc')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 6]) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'created_at')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'updated_at')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->defaultButtons() ?>
                    <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>