<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2017-03-15 21:16
 */

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\helpers\Url;
use frontend\widgets\MenuView;
$this->registerCssFile('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css', [
    'depends' => [\yii\web\JqueryAsset::class], // Đảm bảo jQuery load trước nếu cần
]);
AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php !isset($this->metaTags['keywords']) && $this->registerMetaTag(['name' => 'keywords', 'content' => Yii::$app->feehi->seo_keywords], 'keywords');?>
    <?php !isset($this->metaTags['description']) && $this->registerMetaTag(['name' => 'description', 'content' => Yii::$app->feehi->seo_description], 'description');?>
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=10,IE=9,IE=8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <script>
        window._deel = {
            name: '<?=Yii::$app->feehi->website_title?>',
            url: '<?=Yii::$app->getHomeUrl()?>',
            comment_url: '<?=Url::to(['article/comment'])?>',
            ajaxpager: '',
            commenton: 0,
            roll: [4,]
        }
    </script>

</head>
<?php $this->beginBody() ?>
<body class="home blog">
<?= $this->render('_flash') ?>
<header class="bg-primary text-white text-center py-4">
    <div class="text-center mb-4">
        <img  src="http://quanlynoitru.local//admin/static/img/logoNgang.png" style="height: 100px" alt="Ảnh học sinh" class="avatar img-thumbnail">
        <h1> Trường Cao đẳng GTVT Đường Thủy I</h1>

    </div>
    <h1 class="mt-2">Hệ thống Tra cứu Thông tin</h1>
</header>
<main class="container my-5">
    <?= $content ?>
</main>


<footer class="text-center text-white bg-dark py-3 mt-5">
    &copy; 2025 Trường Cao đẳng GTVT Đường Thủy I
</footer>

</body>
<?php $this->endBody() ?>
<?php
if (Yii::$app->feehi->website_statics_script) {
    echo Yii::$app->feehi->website_statics_script;
}
?>
</html>
<?php $this->endPage() ?>