<?php

use common\libs\Constants;
use common\models\Order;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = $model->code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'code',
            'name',
            [
                'attribute' => 'image',
                'value' => function ($data) {
                    return !empty($data->image) ? "<img style='max-width:100px;max-height:100px' src='" . $data->imageUrl . "' >" : null;
                },
                'format' => 'raw'
            ],
            'price:decimal',
            [
                'attribute' => 'user_id',
                'value' => $model->user->name ?? null,
            ],
            [
                'attribute' => 'shop_id',
                'value' => $model->shop->name ?? null,
            ],
            'description:ntext',
            'content:raw',
            'receive_expiration:date',
            'sales_expiration:date',
            'address:ntext',
            [
                'attribute' => 'status',
                'value' => Order::getStatusItems($model->status)
            ],
            [
                'attribute' => 'is_system',
                'value' => Constants::getYesNoItems($model->is_system)
            ],
            [
                'attribute' => 'type',
                'value' => Order::getTypeItems($model->type)
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
