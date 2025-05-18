<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ThongBaoHeThong */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Thong Bao He Thongs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thong-bao-he-thong-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tieu_de',
            'noi_dung:ntext',
            'nguoi_gui_id',
            'ngay_gui',
            'user_id',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
