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
        <div class="row justify-content-center p-5">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Đăng kí nội trú KTX</h4>
                    </div>
                    <div class="card-body">
                        Thông tin của bạn đã được ghi nhận, vui lòng kiểm tra email của bạn sau 24h!
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