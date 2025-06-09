<?php

use backend\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ViPhamNoiQuy */
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
                <?=$form->field($model, 'hoc_sinh_id')->widget(\kartik\select2\Select2::class, [
                    'data' => $listTTHS,
                    'options' => ['placeholder' => 'Chọn học sinh'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);?>
                <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'loai_vi_pham')->textInput(['maxlength' => true]) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'mo_ta')->textarea(['rows' => 6]) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'ngay_vi_pham')->textInput(['type' => 'date']) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'hinh_thuc_xu_ly')->textInput(['maxlength' => true]) ?>
                        <div class="hr-line-dashed"></div>
                        <?=$form->field($model, 'trinh_do_dao_tao')->label('Trạng thái')->widget(\kartik\select2\Select2::class, [
                            'data' => [
                               0 =>  "Chờ xử lý",
                                1 =>  "Đang xử lý",
                                2 =>  "Đã xử lý",
                            ],
                            'options' => ['placeholder' => 'Trạng thái'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);?>
                        <div class="hr-line-dashed"></div>

<!--                        --><?php //= $form->field($model, 'nguoi_xu_ly')->textInput(['maxlength' => true]) ?>
<!--                        <div class="hr-line-dashed"></div>-->
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