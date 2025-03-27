<?php

use common\libs\Constants;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BankAccount */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bank Accounts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bank-account-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'bank_name',
            'bank_number',
            [
                'attribute' => 'qr_image',
                'value' => !empty($model->qr_image) ? "<img style='max-width:100px;max-height:100px' src='" . $model->imageUrl . "' >" : null,
                'format' => 'raw'
            ],
            [
                'attribute' => 'user_id',
                'value' => $model->user->name ?? null,
            ],
            [
                'attribute' => 'default',
                'value' => Constants::getYesNoItems($model->active),
            ],
            [
                'attribute' => 'active',
                'value' => Constants::getYesNoItems($model->active),
            ],
            [
                'attribute' => 'created_by',
                'value' => $model->createdBy->username ?? null
            ],
            [
                'attribute' => 'updated_by',
                'value' => $model->updatedBy->username ?? null
            ],
            'created_at:datetime',
            'updated_at:datetime'
        ],
    ]) ?>

</div>
