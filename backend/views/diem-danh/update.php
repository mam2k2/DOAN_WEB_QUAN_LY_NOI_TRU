<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\DiemDanh */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Diem Danh'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Update') .' '. yii::t('app', 'Diem Danh')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
