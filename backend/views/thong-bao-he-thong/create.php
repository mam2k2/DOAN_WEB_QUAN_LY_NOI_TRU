<?php

use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\ThongBaoHeThong */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Thong Bao He Thong'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Create') .' '. yii::t('app', 'Thong Bao He Thong')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>

