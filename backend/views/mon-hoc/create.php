<?php

use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\MonHoc */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Mon Hoc'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Create') .' '. yii::t('app', 'Mon Hoc')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>

