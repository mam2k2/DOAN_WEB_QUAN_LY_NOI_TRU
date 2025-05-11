<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\PhongOHocSinh */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Phong O Hoc Sinh'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Update') .' '. yii::t('app', 'Phong O Hoc Sinh')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
