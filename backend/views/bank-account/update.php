<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\BankAccount */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Bank Account'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Update') .' '. yii::t('app', 'Bank Account')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
    'userOptions' => $userOptions
]) ?>
