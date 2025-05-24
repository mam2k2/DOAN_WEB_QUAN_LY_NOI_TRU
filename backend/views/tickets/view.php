<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Tickets */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tickets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tickets-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tieu_de',
            'noi_dung:ntext',
            'danh_muc',
            'trang_thai',
            'do_khan_cap',
            [
                    'attribute' => 'user_id',
                'format' => 'raw',
                'value' => function ($model) {
                    $User = \common\models\User::findOne($model->user_id);
                    return $User->username;
                }
            ],
            [
                'attribute' => 'trang_thai',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->trang_thai !== "") {
                        return \common\models\Tickets::getTrangThaiTicketsArray()[$model->trang_thai];
                    }
                }
            ],
            [
                'attribute' => 'do_khan_cap',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->do_khan_cap !== "") {
                        return \common\models\Tickets::getRateTicketsArray()[$model->do_khan_cap];
                    }
                }
            ],
            [
                    'attribute' => 'created_at',
                'format' => 'datetime',
                
            ]
        ],
    ]) ?>

</div>
