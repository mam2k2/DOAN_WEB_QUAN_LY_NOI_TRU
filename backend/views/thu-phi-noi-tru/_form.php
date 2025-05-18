<?php

use backend\widgets\ActiveForm;
use yii\web\JsExpression;


/* @var $this yii\web\View */
/* @var $model common\models\ThuPhiNoiTru */
/* @var $form backend\widgets\ActiveForm */
?>
<?php
$this->registerJs('
    var giaKhoanPhi = ' . json_encode($listGia) . ';
');
$this->registerJs(<<<JS
$(document).on('change', '.khoan-phi-dropdown', function() {
    var selectedId = $(this).val();
    var item = $(this).closest('.item');

    if (item.length === 0) {
        console.warn("Không tìm thấy .item cho dòng này!");
        return;
    }

    if (giaKhoanPhi[selectedId]) {
        var gia = parseInt(giaKhoanPhi[selectedId]);
        var inputTien = item.find('.so-tien-input');

        if (inputTien.length === 0) {
            console.warn("Không tìm thấy input .so-tien-input trong .item!");
        }

        inputTien.val(gia);
    }
});

JS);
?>
<?php
$this->registerJs(<<<JS
if (!$('#ngay-thu-input').val()) {
    let now = new Date();
    let value = now.toISOString().split('T')[0]; // YYYY-MM-DD
    document.getElementById('ngay-thu-input').value = value;
}
JS);
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?php $form = ActiveForm::begin([
                    'id' => 'dynamic-form' ,
                    'options' => [
                    ]
                ]); ?>
                    <div class="row">
                        <div class="col-6">
                            <div class="hr-line-dashed"></div>
                            <?=$form->field($model, 'hoc_sinh_id')->widget(\kartik\select2\Select2::class, [
                                'data' => $listTTHS,
                                'options' => ['placeholder' => 'Chọn học sinh'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);?>
                            <div class="hr-line-dashed"></div>

                            <?=$form->field($model, 'phong_id')->widget(\kartik\select2\Select2::class, [
                                'data' => $listPhongO,
                                'options' => ['placeholder' => 'Chọn Phòng'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);?>
                            <div class="hr-line-dashed"></div>

                            <?= $form->field($model, 'ngay_thu')->textInput(['type'=> 'date','id' => 'ngay-thu-input']) ?>
                            <div class="hr-line-dashed"></div>


                            <?=$form->field($model, 'trang_thai')->widget(\kartik\select2\Select2::class, [
                                'data' => [
                                        0 => 'Chưa thu',
                                        1 => 'Đã thu'
                                ],
                                'options' => ['placeholder' => 'Trạng thái'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);?>
                            <div class="hr-line-dashed"></div>

                            <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 6]) ?>
                            <div class="hr-line-dashed"></div>
                        </div>
                        <div class="col-6">
                            <div class="">
                                <?php \wbraganca\dynamicform\DynamicFormWidget::begin([
                                    'widgetContainer' => 'dynamicform_wrapper',
                                    'widgetBody' => '.container-items',
                                    'widgetItem' => '.item',
                                    'limit' => 10,
                                    'min' => 1,
                                    'insertButton' => '.add-item',
                                    'deleteButton' => '.remove-item',
                                    'model' => $modelsChiTiet[0],
                                    'formId' => 'dynamic-form',
                                    'formFields' => [
                                        'noi_dung',
                                        'so_tien',
                                        'ma_khoan_thu',
                                    ],
                                ]); ?>
                                    <button type="button" class="add-item btn btn-success btn-xs mb-2">Thêm khoản phí</button>
                                    <div class="container-items border p-3" style="max-height: 55vh; min-height: 55vh;overflow-y: auto;">
                                        <?php foreach ($modelsChiTiet as $i => $modelChiTiet): ?>
                                            <div class="item panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title pull-left">Khoản phí mới</h3>
                                                    <div class="pull-right">
                                                        <button type="button" class="remove-item btn btn-danger btn-xs">Xóa</button>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="panel-body">
                                                    <?= $form->field($modelChiTiet, "[{$i}]khoan_phi_id")->dropDownList(
                                                        $listKhoan,
                                                        [
                                                            'prompt' => 'Khoản thanh toán',
                                                            'class' => 'form-control khoan-phi-dropdown',

                                                        ]
                                                    ); ?>
                                                    <?= $form->field($modelChiTiet, "[{$i}]so_tien")->textInput(
                                                            [
                                                                    'type' => 'number',
                                                                'class' => 'form-control so-tien-input',
                                                            ]
                                                    ) ?>
                                                    <?= $form->field($modelChiTiet, "[{$i}]ghi_chu")->textarea(['maxlength' => true]) ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php \wbraganca\dynamicform\DynamicFormWidget::end(); ?>
                            </div>
                        </div>
                    </div>




                        <?= $form->defaultButtons() ?>
                    <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
