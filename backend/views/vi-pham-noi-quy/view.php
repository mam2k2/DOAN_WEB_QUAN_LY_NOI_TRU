<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ViPhamNoiQuy */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vi Pham Noi Quies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vi-pham-noi-quy-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'hoc_sinh_id',
            'loai_vi_pham',
            'mo_ta:ntext',
            'ngay_vi_pham',
            'hinh_thuc_xu_ly',
            'nguoi_xu_ly',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
