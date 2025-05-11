<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\KhuKtx */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Khu Ktxes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="khu-ktx-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'id',
                'label' => 'ID',
            ],
            [
                'attribute' => 'ma_khu',
                'label' => 'Mã Khu',
            ],
            [
                'attribute' => 'ten_khu',
                'label' => 'Tên Khu',
            ],
            [
                'attribute' => 'vi_tri',
                'label' => 'Vị trí',
            ],
            [
                'attribute' => 'ghi_chu',
                'label' => 'Ghi chú',
                'format' => 'ntext',
            ],
//            'created_at',
//            'updated_at',
        ],
    ]) ?>

</div>
