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

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'khu_id',
            'ma_phong',
            'ten_phong',
            'suc_chua',
            'so_luong_hien_tai',
            'vi_tri',
            'ghi_chu:ntext',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
