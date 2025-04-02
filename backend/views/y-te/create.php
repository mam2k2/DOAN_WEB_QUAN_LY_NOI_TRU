<?php

use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\YTe */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Y Te'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Create') .' '. yii::t('app', 'Y Te')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>

