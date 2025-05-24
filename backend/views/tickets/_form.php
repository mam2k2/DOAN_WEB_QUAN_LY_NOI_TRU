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

                        <?= $form->field($model, 'trang_thai')->dropDownList([ 'open' => 'Open', 'in_progress' => 'In progress', 'closed' => 'Closed', ], ['prompt' => '']) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'do_khan_cap')->dropDownList([ 'low' => 'Low', 'medium' => 'Medium', 'high' => 'High', 'urgent' => 'Urgent', ], ['prompt' => '']) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'user_id')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'assigned_to')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'created_at')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'updated_at')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->defaultButtons() ?>
                    <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>