<?php

use backend\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\KhoanPhi */
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
                    <?= $form->field($model, 'ten_khoan_phi')->textInput(['maxlength' => true]) ?>
                        <div class="hr-line-dashed"></div>

                    <?=$form->field($model, 'loai_phi')->widget(\kartik\select2\Select2::class, [
                        'data' => [
                            "Cố định",
                            "Linh hoạt",
                        ],
                        'options' => ['placeholder' => 'Chọn khoản phí'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);?>

                        <?= $form->field($model, 'so_tien')->textInput(['maxlength' => true]) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 6]) ?>
                        <div class="hr-line-dashed"></div>
<!---->
<!--                        --><?php //= $form->field($model, 'created_at')->textInput() ?>
<!--                        <div class="hr-line-dashed"></div>-->
<!---->
<!--                        --><?php //= $form->field($model, 'updated_at')->textInput() ?>
<!--                        <div class="hr-line-dashed"></div>-->

                        <?= $form->defaultButtons() ?>
                    <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>