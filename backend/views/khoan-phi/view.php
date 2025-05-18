<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\KhoanPhi */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Khoan Phis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="khoan-phi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ten_khoan_phi',
            'loai_phi',
            'so_tien',
            'ghi_chu:ntext',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
