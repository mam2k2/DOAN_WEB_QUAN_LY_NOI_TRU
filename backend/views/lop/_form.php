<?php

use backend\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Lop */
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
                        <?=$form->field($model, 'khoa_id')->widget(\kartik\select2\Select2::class, [
                            'data' => $listKhoa,
                            'options' => ['placeholder' => 'Chọn khoa'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);?>
                         <div class="hr-line-dashed"></div>
                        <?=$form->field($model, 'chu_nghiem_id')->widget(\kartik\select2\Select2::class, [
                            'data' => $listGiaoVien,
                            'options' => ['placeholder' => 'Chọn Giáo Viên Chủ Nghiệm'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);?>

                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'ten_lop')->textInput(['maxlength' => true]) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'ngay_bat_dau')->textInput(['type' => 'date']) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 6]) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->defaultButtons() ?>
                    <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>