<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Khoa */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Khoas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="khoa-view">

    <h1>Thông tin khóa #<?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ten_khoa',
            [
                    'attribute' => 'created_at',
                'format' => ['date', 'php:d-m-Y H:i:s'],
            ],
            [
                    'attribute' => 'updated_at',
                'format' => ['date', 'php:d-m-Y H:i:s'],
            ]
        ],
    ]) ?>

</div>
