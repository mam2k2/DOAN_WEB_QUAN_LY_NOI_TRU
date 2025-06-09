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
                       $model = new \common\models\ThongTinHocSinh();
                    }
                ?>
                <?= $form->field($model, 'anh_chan_dung')->imgInput() ?>
                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'ho_va_ten')->textInput(['id' => 'ho_va_ten']) ?>
                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'email')->textInput(['type' => 'email']) ?>
                <?= $form->field($model, 'emailPH')->textInput(['type' => 'email'])->label('Email phụ huynh') ?>
                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'cccd')->textInput(['type' => 'number']) ?>
                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'sdt_ca_nhan')->textInput(['type' => 'number']) ?>
                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'sdt_gia_dinh')->textInput(['type' => 'number']) ?>
                <div class="hr-line-dashed"></div>
                <?=$form->field($model, 'phong_id')->widget(\kartik\select2\Select2::class, [
                    'data' => $phongList,
                    'options' => ['placeholder' => 'Chọn phòng'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);?>
                <div class="hr-line-dashed"></div>

                <?=$form->field($model, 'lop_id')->widget(\kartik\select2\Select2::class, [
                    'data' => $listLop,
                    'options' => ['placeholder' => 'Chọn khoa'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);?>
                <?php
                $model->uu_tien = 0;
                ?>
                <?=$form->field($model, 'uu_tien')->label('Ưu tiên')->widget(\kartik\select2\Select2::class, [
                    'data' => \common\models\ThongTinHocSinh::getUuTien(),
                    'options' => ['placeholder' => 'Ưu tiên'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);?>
                <div class="hr-line-dashed"></div>
                <?=$form->field($model, 'truong_thcs')->widget(\kartik\select2\Select2::class, [
                    'data' => $thcsList,
                    'options' => ['placeholder' => 'Trường THCS'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);?>
                <div class="hr-line-dashed"></div>
                <?=$form->field($model, 'truong_thpt')->widget(\kartik\select2\Select2::class, [
                    'data' => $thptList,
                    'options' => ['placeholder' => 'Trường THPT'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);?>
                <div class="hr-line-dashed"></div>
                <?=$form->field($model, 'trinh_do_dao_tao')->label('Bậc đào tạo')->widget(\kartik\select2\Select2::class, [
                    'data' => [
                        "Cao đẳng" =>  "Cao đẳng",
                        "Trung cấp" =>  "Trung cấp",
                        "Sơ cấp" =>  "Sơ cấp",
                    ],
                    'options' => ['placeholder' => 'Hệ đào tạo'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);?>
                <div class="hr-line-dashed"></div>
                        <?= $form->field($model, 'username')->textInput(['id' => 'username', 'readonly' => true]) ?>
                            <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'password')->textInput() ?>
                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'usernamePH')->textInput(['id' => 'usernamePH', 'readonly' => true])->label("Username phụ huynh") ?>
                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'passwordPH')->textInput()->label("Mật khẩu phụ huynh") ?>
                <div class="hr-line-dashed"></div>


                        <?= $form->field($model, 'ngay_sinh')->textInput(['type' => 'date']) ?>
                        <div class="hr-line-dashed"></div>

                <?=$form->field($model, 'que_quan')->widget(\kartik\select2\Select2::class, [
                    'data' => $tinhThanhList,
                    'options' => ['placeholder' => 'Quê quán'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);?>                        <div class="hr-line-dashed"></div>
<!--                '0-Đã Tốt nghiệp,1-Đã rời đi, 2 chờ duyệt-->
                        <?=$form->field($model, 'trang_thai')->widget(\kartik\select2\Select2::class, [
                            'data' => [
                                0=>"Đã Tốt nghiệp",
                                1 => "Đang học",
                                2 => "Bảo lưu",
                                3 => "Chờ duyệt",
                            ],
                            'options' => ['placeholder' => 'Trạng thái'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);?>
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
if($model->id == 0){
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
            $('#usernamePH').val('ph_'+username);
        }
    });
JS);
}
