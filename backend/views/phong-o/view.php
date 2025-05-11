<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\PhongO */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Phong Os'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phong-o-view">

    <h1>Phòng ở : <?= Html::encode($this->title) ?> - <?= Html::encode($model->ten_phong) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'ten_khu',
                'label' => 'Tên Khu',
            ],
            'ma_phong',
            'ten_phong',
            'suc_chua',
            'so_luong_hien_tai',
            'vi_tri',
            'ghi_chu:ntext',
            [
                'label' => 'Danh sách thiết bị',
                'format' => 'raw',
                'value' => function ($model) {
                    $list = array_map(function($tb) {
                        return Html::encode($tb->id . " - " . $tb->ten_thiet_bi ." (".$tb->tinh_trang.")"); // thay 'ten_thiet_bi' bằng tên cột thật
                    }, $model->thietBiKtxs);

                    return empty($list) ? '(Không có thiết bị)' : implode('<br>', $list);
                },
            ],
            [
                'label' => 'Danh sách thiết bị',
                'format' => 'raw',
                'value' => function ($model) {
                    $list = array_map(function($tb) {
                        return Html::encode($tb->ho_va_ten) ."-". Html::encode($tb->cccd); // thay 'ten_thiet_bi' bằng tên cột thật
                    }, $model->phongOHocSinhs);

                    return empty($list) ? '(Chưa có ai thuê phòng)' : implode('<br>', $list);
                },
            ],
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
