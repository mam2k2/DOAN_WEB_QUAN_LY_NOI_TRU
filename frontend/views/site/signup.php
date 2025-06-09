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
$this->registerCssFile('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', [
    'position' => \yii\web\View::POS_END
]);

\frontend\assets\AppAsset::register($this);
$this->title = Yii::t('app', 'Đăng kí nội trú');
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
    <?php
    \yii\bootstrap\Modal::begin([
        'header' => '<h4>NỘI QUY KÝ TÚC XÁ</h4>',
        'id' => 'rulesModal',
        'size' => 'modal-lg',
    ]);

    echo <<<HTML
<strong>Trường Cao đẳng Giao thông Vận tải Đường thủy I</strong><br><br>

<b>I. Quy định chung</b><br>
- Chấp hành nghiêm chỉnh nội quy của trường, các quy định của ký túc xá và pháp luật của Nhà nước.<br>
- Có thái độ văn minh, lịch sự, tôn trọng người quản lý và các bạn cùng ở.<br>
- Tích cực giữ gìn vệ sinh chung, không vứt rác bừa bãi, tiết kiệm điện, nước.<br><br>

<b>II. Về giờ giấc</b><br>
- Giờ mở cổng: 05h30 – 22h00 hàng ngày.<br>
- Yên tĩnh sau 22h00 để đảm bảo học tập và nghỉ ngơi.<br>
- Không gây tiếng ồn, không bật nhạc to, không chơi thể thao trong phòng.<br>
- Khi ra ngoài sau 22h00 phải được sự cho phép của Ban quản lý KTX.<br><br>

<b>III. Về sinh hoạt</b><br>
- Giữ gìn vệ sinh phòng ở, khu vực chung. Tham gia trực nhật, tổng vệ sinh theo quy định.<br>
- Sử dụng đúng nơi quy định đối với rác thải, dụng cụ vệ sinh, đồ dùng chung.<br>
- Không nuôi gia súc, gia cầm, động vật hoang dã trong KTX.<br>
- Không nấu nướng, đun nước bằng các thiết bị không an toàn trong phòng.<br><br>

<b>IV. Về an ninh, trật tự</b><br>
- Không mang, tàng trữ, sử dụng vũ khí, chất cháy nổ, ma túy, chất kích thích.<br>
- Không tổ chức cờ bạc, uống rượu bia, tụ tập gây mất trật tự.<br>
- Không mượn, cho mượn, sang nhượng chỗ ở khi chưa được phép.<br>
- Khóa cửa cẩn thận khi ra ngoài, bảo quản tài sản cá nhân.<br><br>

<b>V. Về nghĩa vụ tài chính</b><br>
- Đóng phí nội trú đầy đủ, đúng hạn theo quy định của trường.<br>
- Chịu trách nhiệm bồi thường thiệt hại nếu làm hư hỏng tài sản của KTX.<br><br>

<b>VI. Khen thưởng và kỷ luật</b><br>
- <b>Khen thưởng:</b> Chấp hành tốt, giữ gìn vệ sinh, giúp đỡ bạn bè sẽ được khen.<br>
- <b>Kỷ luật:</b> Vi phạm sẽ bị nhắc nhở, cảnh cáo, buộc rời KTX hoặc xử lý bởi nhà trường.<br>
HTML;

    \yii\bootstrap\Modal::end();
    ?>
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

                                        <?=$form->field($model, 'que_quan')->label('Quê quán')->widget(\kartik\select2\Select2::class, [
                                            'data' => $tinhThanhList,
                                            'options' => ['placeholder' => 'Quê quán'],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]);?>
                                        <div class="hr-line-dashed"></div>
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
                                        <?=$form->field($model, 'truong_thcs')->label('Trường THCS')->widget(\kartik\select2\Select2::class, [
                                            'data' => $thcsList,
                                            'options' => ['placeholder' => 'Trường THCS'],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]);?>
                                        <div class="hr-line-dashed"></div>
                                        <?=$form->field($model, 'truong_thpt')->label('Trường THPT')->widget(\kartik\select2\Select2::class, [
                                            'data' => $thptList,
                                            'options' => ['placeholder' => 'Trường THPT'],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]);?>
                                        <div class="hr-line-dashed"></div>
                                        <?php
                                        $model->trinh_do_dao_tao = "Cao đẳng";
                                        ?>
                                        <?=$form->field($model, 'trinh_do_dao_tao')->label('Bậc đào tạo')->widget(\kartik\select2\Select2::class, [
                                            'data' => [
                                                "Cao đẳng" =>  "Cao đẳng",
                                                "Trung cấp" =>  "Trung cấp",
                                                "Sơ cấp" =>  "Sơ cấp",
                                            ],
                                            'options' => ['placeholder' => 'Bậc đào tạo'],
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
                                        <div class="form-group field-acceptRules">
                                            <div class="checkbox">
                                                <label>
                                                    <?= Html::activeCheckbox($model, 'acceptRules', ['label' => false, 'id' => 'acceptRulesCheckbox']) ?>
                                                    Tôi đã đọc và đồng ý với
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#rulesModal">nội quy ký túc xá</a>.
                                                </label>
                                            </div>
                                            <div class="help-block">
                                                <?= $model->hasErrors('acceptRules') ? $model->getFirstError('acceptRules') : '' ?>
                                            </div>
                                        </div>
                                        <?= Html::submitButton('Gửi đăng ký', ['class' => 'btn btn-success', 'id' => 'submitBtn', 'disabled' => true]) ?>
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
<?php
$js = <<<JS
$('#acceptRulesCheckbox').change(function() {
    $('#submitBtn').prop('disabled', !this.checked);
});
JS;
$this->registerJs($js);
?>
<?php $this->endPage() ?>
