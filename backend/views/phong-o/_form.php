<?php

use backend\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PhongO */
/* @var $listKhu common\models\KhuKtx */
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
                        <?=$form->field($model, 'khu_id')->widget(\kartik\select2\Select2::class, [
                            'data' => $listKhu,
                            'options' => ['placeholder' => 'Chọn khu'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);?>
                         <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'hinh_anh')->imgInput() ?>
                         <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'ma_phong')->textInput(['maxlength' => true]) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'ten_phong')->textInput(['maxlength' => true]) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'suc_chua')->textInput(['type' => 'number', 'min' => 0,'max' => 100]) ?>
                        <div class="hr-line-dashed"></div>

<!--                        --><?php //= $form->field($model, 'so_luong_hien_tai')->textInput() ?>
<!--                        <div class="hr-line-dashed"></div>-->

                        <?= $form->field($model, 'vi_tri')->textInput(['maxlength' => true]) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 6]) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->defaultButtons() ?>
                    <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>