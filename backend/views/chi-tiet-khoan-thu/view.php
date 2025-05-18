<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ChiTietKhoanThu */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Chi Tiet Khoan Thus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chi-tiet-khoan-thu-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'thu_phi_noi_tru_id',
            'khoan_phi_id',
            'so_tien',
            'ghi_chu:ntext',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
