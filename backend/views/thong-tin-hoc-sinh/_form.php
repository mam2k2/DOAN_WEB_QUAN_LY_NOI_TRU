<?php

use backend\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ThongTinHocSinh */
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
                <?php
                    if(!$model instanceof \yii\db\ActiveRecord){
                       echo $model;
                    }
                ?>
                <?= $form->field($model, 'anh_chan_dung')->imgInput() ?>
                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'ho_va_ten')->textInput(['id' => 'ho_va_ten']) ?>
                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'email')->textInput(['type' => 'email']) ?>
                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'cccd')->textInput(['type' => 'number']) ?>
                <div class="hr-line-dashed"></div>
                        <?= $form->field($model, 'username')->textInput(['id' => 'username', 'readonly' => true]) ?>
                            <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'password')->textInput() ?>
                    <div class="hr-line-dashed"></div>
                        <?=$form->field($model, 'lop_id')->widget(\kartik\select2\Select2::class, [
                            'data' => $listLop,
                            'options' => ['placeholder' => 'Chọn khoa'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'ngay_sinh')->textInput(['type' => 'date']) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'que_quan')->textInput(['maxlength' => true]) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'trang_thai')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'diem_trung_binh')->textInput(['maxlength' => true]) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'ngay_bat_dau')->textInput(['type' => 'date']) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 6]) ?>
                        <div class="hr-line-dashed"></div>

                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'anh_cccd_truoc')->imgInput() ?>
                                <div class="hr-line-dashed"></div>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'anh_cccd_sau')->imgInput() ?>
                                <div class="hr-line-dashed"></div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <?= $form->defaultButtons() ?>
                    <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJs(<<<JS

    function generateUsername(fullName) {
        // Chuyển Đ/đ → D/d
        fullName = fullName.replace(/Đ/g, 'D').replace(/đ/g, 'd');
    
        // Bỏ dấu
        let base = fullName.normalize("NFD").replace(/[\u0300-\u036f]/g, "")
                      .toLowerCase()
                      .replace(/[^a-z0-9]/g, ''); // Xóa khoảng trắng, ký tự đặc biệt
    
        let random = Math.floor(Math.random() * 9000) + 1000;
        return base + '_{{ID}}' ;
    }

    $('#ho_va_ten').on('blur', function() {
        var fullName = $(this).val();
        if (fullName) {
            let username = generateUsername(fullName);
            $('#username').val(username);
        }
    });
JS);
?>
