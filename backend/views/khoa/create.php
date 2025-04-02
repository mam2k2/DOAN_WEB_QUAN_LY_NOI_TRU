<?php

use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\Khoa */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Khoa'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Create') .' '. yii::t('app', 'Khoa')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>

