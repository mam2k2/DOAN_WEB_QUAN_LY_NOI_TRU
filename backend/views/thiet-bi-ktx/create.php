<?php

use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\ThietBiKtx */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Thiet Bi Ktx'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Create') .' '. yii::t('app', 'Thiet Bi Ktx')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
    'phongOList' => $phongOList,
]) ?>

