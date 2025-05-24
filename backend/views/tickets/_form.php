<?php

use backend\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Tickets */
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
                    <?= $form->field($model, 'tieu_de')->textInput(['maxlength' => true]) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'noi_dung')->textarea(['rows' => 6]) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'danh_muc')->dropDownList([ 'Sửa chữa' => 'Sửa chữa', 'Vệ sinh' => 'Vệ sinh', 'Khác' => 'Khác', ], ['prompt' => '']) ?>
                        <div class="hr-line-dashed"></div>

                <?= $form->field($model, 'danh_muc')->dropDownList([
                    'sửa chữa' => 'Sửa chữa',
                    'vệ sinh' => 'Vệ sinh',
                    'khác' => 'Khác',
                ], ['prompt' => 'Chọn danh mục']) ?>
                <div class="hr-line-dashed"></div>

                <?= $form->field($model, 'do_khan_cap')->dropDownList([
                    'low' => 'Thấp',
                    'medium' => 'Trung bình',
                    'high' => 'Cao',
                    'urgent' => 'Khẩn cấp'
                ], ['prompt' => 'Chọn trạng thái']) ?>
                       <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'trang_thai')->dropDownList(\common\models\Tickets::getTrangThaiTicketsArray(), ['prompt' => 'Chọn mức độ khẩn cấp']) ?>
                <div class="hr-line-dashed"></div>

                        <?= $form->defaultButtons() ?>
                    <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>