<?php

use backend\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ThietBiKtx */
/* @var $form backend\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?php $form = ActiveForm::begin([
                    'options' => [
                        'enctype' => 'multipart/form-data',
                    ]
                ]); ?>
                <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'ma_thiet_bi')->textInput(['maxlength' => true]) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'ten_thiet_bi')->textInput(['maxlength' => true]) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'hinh_anh')->imgInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?=$form->field($model, 'phong_o_id')->widget(\kartik\select2\Select2::class, [
                            'data' => $phongOList,
                            'options' => ['placeholder' => 'Chọn phòng'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);?>
                        <div class="hr-line-dashed"></div>

                        <?=$form->field($model, 'tinh_trang')->widget(\kartik\select2\Select2::class, [
                            'data' => [
                                    "Hoạt động",
                                "Bảo trì",
                                "Thanh lý",
                            ],
                            'options' => ['placeholder' => 'Chọn phòng'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'ngay_bao_tri')->textInput(['type' => 'date']) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 6]) ?>
                        <div class="hr-line-dashed"></div>


                        <?= $form->defaultButtons() ?>
                    <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>