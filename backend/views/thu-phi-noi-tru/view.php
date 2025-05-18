<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ThuPhiNoiTru */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Thu Phi Noi Trus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thu-phi-noi-tru-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'hoc_sinh_id',
            'khoan_phi_id',
            'phong_id',
            'so_tien',
            'ngay_thu',
            'nguoi_thu',
            'trang_thai',
            'ghi_chu:ntext',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
