<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2017-03-15 21:16
 */

/* @var $this yii\web\View */
/* @var $form \yii\bootstrap\ActiveForm*/
/* @var $model \frontend\models\form\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->registerCssFile('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css', [
    'depends' => [\yii\web\JqueryAsset::class], // Đảm bảo jQuery load trước nếu cần
]);
\frontend\assets\AppAsset::register($this);
$this->title = Yii::t('app', 'Login') . '-' . Yii::$app->feehi->website_title;
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="renderer" content="webkit">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <style>

            img#loginform-captcha-image{
                position: absolute;
                top: 2px;
                right: 1px;
            }
        </style>
    </head>
    <body class="gray-bg">
    <?php $this->beginBody() ?>
    <div class="content-wrap">
        <div class="fill">
            <div class="marginTop">

            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-12 col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Đăng kí nội trú KTX</h4>
                    </div>
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="ibox">
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
                                        <?= $form->field($model, 'anh_chan_dung')->fileInput(['class' => 'form-control']) ?>
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
                                        <?= $form->field($model, 'ngay_sinh')->textInput(['type' => 'date']) ?>
                                        <div class="hr-line-dashed"></div>

                                        <?= $form->field($model, 'que_quan')->textInput(['maxlength' => true]) ?>
                                        <div class="hr-line-dashed"></div>
                                        <?= $form->field($model, 'truong_thcs')->textInput() ?>
                                        <div class="hr-line-dashed"></div>
                                        <?= $form->field($model, 'truong_thpt')->textInput() ?>
                                        <div class="hr-line-dashed"></div>
                                        <?php
                                        $model->trinh_do_dao_tao = "Cao đẳng";
                                        ?>
                                        <?=$form->field($model, 'trinh_do_dao_tao')->label('Hệ đào tạo')->widget(\kartik\select2\Select2::class, [
                                            'data' => [
                                                "Cao đẳng" =>  "Cao đẳng",
                                                "Trung cấp" =>  "Trung cấp",
                                                "Cấp 3" =>  "Cấp 3",
                                            ],
                                            'options' => ['placeholder' => 'Hệ đào tạo'],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]);?>
                                        <div class="hr-line-dashed"></div>
                                        <?=$form->field($model, 'lop_id')->label('Lớp')->widget(\kartik\select2\Select2::class, [
                                            'data' => $lopList,
                                            'options' => ['placeholder' => 'Lớp'],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]);?>
                                        <div class="hr-line-dashed"></div>
                                        <!--                '0-Đã Tốt nghiệp,1-Đã rời đi, 2 chờ duyệt-->

<!--                                        --><?php //= $form->field($model, 'diem_trung_binh')->textInput(['maxlength' => true]) ?>
<!--                                        <div class="hr-line-dashed"></div>-->

                                        <?= $form->field($model, 'ngay_bat_dau')->textInput(['type' => 'date']) ?>

                                        <div class="hr-line-dashed"></div>

                                        <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 6]) ?>
                                        <div class="hr-line-dashed"></div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <?= $form->field($model, 'anh_cccd_truoc')->fileInput(['class' => 'form-control']) ?>
                                                <div class="hr-line-dashed"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <?= $form->field($model, 'anh_cccd_sau')->fileInput(['class' => 'form-control']) ?>
                                                <div class="hr-line-dashed"></div>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>

                                        <button class="btn btn-primary">Nộp đơn</button>
                                        <button class="btn btn-danger">Hủy</button>
                                        <?php ActiveForm::end(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="card-footer text-muted text-center">
                        &copy; 2025 Trường Cao đẳng GTVT Đường Thủy I
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>