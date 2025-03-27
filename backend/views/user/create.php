<?php

use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'User'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Create') .' '. yii::t('app', 'User')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>

