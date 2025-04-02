<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\LichHoc */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lich Hocs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lich-hoc-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'mon_id',
            'thu_trong_tuan',
            'tiet',
            'thoi_gian_bat_dau',
            'thoi_gian_ket_thuc',
            'ghi_chu:ntext',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
