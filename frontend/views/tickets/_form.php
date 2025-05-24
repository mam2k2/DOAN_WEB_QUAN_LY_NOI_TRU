<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $model \common\models\Tickets */

?>

<div class="student-request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tieu_de')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noi_dung')->textarea(['rows' => 5]) ?>

    <?= $form->field($model, 'danh_muc')->dropDownList([
        'sửa chữa' => 'Sửa chữa',
        'vệ sinh' => 'Vệ sinh',
        'khác' => 'Khác',
    ], ['prompt' => 'Chọn danh mục']) ?>
    <?= $form->field($model, 'do_khan_cap')->dropDownList([
        'low' => 'Thấp',
        'medium' => 'Trung bình',
        'high' => 'Cao',
        'urgent' => 'Khẩn cấp'
    ], ['prompt' => 'Chọn mức độ khẩn cấp']) ?>
    <?= $form->field($model, 'isAnDanh')->checkbox() ?>

    <?= Html::submitButton($model->isNewRecord ? 'Gửi yêu cầu' : 'Cập nhật', ['class' => 'btn btn-success']) ?>

    <?php ActiveForm::end(); ?>

</div>
