<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\PhongO */
/* @var $listKhu common\models\KhuKtx */


$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Phong O'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Update') .' '. yii::t('app', 'Phong O')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
    'listKhu' => $listKhu,
]) ?>
