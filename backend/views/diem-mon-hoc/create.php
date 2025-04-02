<?php

use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\DiemMonHoc */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Diem Mon Hoc'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Create') .' '. yii::t('app', 'Diem Mon Hoc')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>

