<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ThietBiKtx */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Thiet Bi Ktxes'), 'url' => ['index']];
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

</div>
