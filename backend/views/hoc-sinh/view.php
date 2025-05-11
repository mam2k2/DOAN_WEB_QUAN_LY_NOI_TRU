<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HocSinh */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hoc Sinhs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hoc-sinh-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ho_va_ten',
            'ngay_sinh',
            'cccd',
            'dia_chi',
            'sdt_ca_nhan',
            'sdt_gia_dinh',
            'ten_day_du',
            'que_quan',
            [
                'attribute' => 'trang_thai_text',
                'label' => 'Trạng thái',
            ],
            'diem_trung_binh',
            'ngay_bat_dau',
            'ghi_chu',
            [
                'attribute' => 'created_at_hs',
                'label' => 'Ngày tạo',
                'format' => ['date', 'php:d/m/Y'],
            ],
            [
                'attribute' => 'updated_at_hs',
                'label' => 'Ngày cập nhật',
                'format' => ['date', 'php:d/m/Y'],
            ],
        ],
    ]) ?>

</div>
