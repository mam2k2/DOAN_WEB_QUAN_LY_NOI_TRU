<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $branchOptions array */
/* @var $categoryOptions array */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Product'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Update') .' '. yii::t('app', 'Product')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
    'branchOptions' => $branchOptions,
    'categoryOptions' => $categoryOptions
]) ?>
