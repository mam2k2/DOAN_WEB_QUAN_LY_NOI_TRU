<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Lop */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lops'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lop-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'khoa_id',
            'chu_nghiem_id',
            'ten_lop',
            'ngay_bat_dau',
            'ghi_chu:ntext',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
