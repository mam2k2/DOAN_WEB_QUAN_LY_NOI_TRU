<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-03-25 11:15
 */

/**
 * @var $this yii\web\View
 * @var $model common\models\AdminUser
 */
use backend\widgets\ActiveForm;
$this->title = "Admin";
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
                <?= $form->field($model, 'username')->textInput(['maxlength' => 64, 'disabled' => 'disabled']) ?>
                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'avatar')->imgInput() ?>
                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'email')->textInput(['maxlength' => 64]) ?>
                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'old_password')->passwordInput(['maxlength' => 512]) ?>
                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'password')->passwordInput(['maxlength' => 512]) ?>
                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'repassword')->passwordInput(['maxlength' => 512]) ?>
                <div class="hr-line-dashed"></div>
                <?= $form->defaultButtons() ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>