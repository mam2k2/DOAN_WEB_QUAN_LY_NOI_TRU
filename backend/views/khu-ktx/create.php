<?php

use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\KhuKtx */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Khu Ktx'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Create') .' '. yii::t('app', 'Khu Ktx')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>

