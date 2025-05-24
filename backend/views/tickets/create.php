<?php

use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\Tickets */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Tickets'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Create') .' '. yii::t('app', 'Tickets')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>

