<?php

use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\Lop */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Lop'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Create') .' '. yii::t('app', 'Lop')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>

