<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\KhoanPhi */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Khoan Phi'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Update') .' '. yii::t('app', 'Khoan Phi')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
