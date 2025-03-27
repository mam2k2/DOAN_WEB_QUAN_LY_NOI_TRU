<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\BankAccount */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'User'), 'url' => Url::to(['index'])],
    ['label' => ($userModel->name ?? "") . " - " .yii::t('app', 'Bank Account'), 'url' => Url::to(['view-banks', 'userId' => $userModel->id])],
    ['label' => yii::t('app', 'Update') .' '. yii::t('app', 'Bank Account')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
