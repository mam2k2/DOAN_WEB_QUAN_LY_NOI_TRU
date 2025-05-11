<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ThietBiKtx */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Thiet Bi Ktxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thiet-bi-ktx-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ma_thiet_bi',
            'ten_thiet_bi',
            'phong_o_id',
            'tinh_trang',
            'ngay_bao_tri',
            'ghi_chu:ntext',
            'created_at',
            'updated_at',
        ],
    ]) ?>
    <center>
        <?= $model->hinh_anh == null ? "Chưa cập nhật hình ảnh phòng" : \yii\helpers\Html::a(
            \yii\helpers\Html::img($model->hinh_anh, ['style' => 'width: 50%; height: auto; cursor: pointer;','class' => 'img-thumbnail mt-5']),
            'javascript:void(0)',
            [
                'title' => 'Xem ảnh',
                'data-pjax' => '0',
                'class' => 'btn-sm',
                //['thiet-bi-ktx/index', 'ThietBiKtxSearch[phong_o_id]' => $model->id]
                'onclick' => "viewLayer('$model->hinh_anh', $(this))",
            ]
        );
        ?>
    </center>
</div>
