<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Branch */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Branch'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Update') .' '. yii::t('app', 'Branch')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
