<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\PhongOHocSinh */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Phong O Hoc Sinhs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phong-ohoc-sinh-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'hoc_sinh_id',
            'phong_id',
            'thoi_gian_bat_dau',
            'trang_thai',
            'ghi_chu:ntext',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
