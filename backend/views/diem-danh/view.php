<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\DiemDanh */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Diem Danhs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diem-danh-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'hoc_sinh_id',
            'phong_id',
            'ngay_diem_danh',
            'thoi_gian',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
