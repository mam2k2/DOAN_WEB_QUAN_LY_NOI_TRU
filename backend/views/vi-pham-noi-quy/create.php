<?php

use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\ViPhamNoiQuy */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Vi Pham Noi Quy'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Create') .' '. yii::t('app', 'Vi Pham Noi Quy')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>

