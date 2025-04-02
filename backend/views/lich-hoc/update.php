<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\LichHoc */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Lich Hoc'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Update') .' '. yii::t('app', 'Lich Hoc')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
