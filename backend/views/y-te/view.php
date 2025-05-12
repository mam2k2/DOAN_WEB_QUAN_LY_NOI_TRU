<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\YTe */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Y Tes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yte-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'hoc_sinh_id',
            'ngay_bi_benh',
            'ghi_chu:ntext',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
