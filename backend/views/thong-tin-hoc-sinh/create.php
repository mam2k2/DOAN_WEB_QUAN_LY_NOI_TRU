<?php

use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\ThongTinHocSinh */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Thong Tin Hoc Sinh'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Create') .' '. yii::t('app', 'Thong Tin Hoc Sinh')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>

