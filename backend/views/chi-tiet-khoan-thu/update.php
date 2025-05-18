<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\ChiTietKhoanThu */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Chi Tiet Khoan Thu'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Update') .' '. yii::t('app', 'Chi Tiet Khoan Thu')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
