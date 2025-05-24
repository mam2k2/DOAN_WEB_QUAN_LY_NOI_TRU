<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Tickets */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tickets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tickets-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tieu_de',
            'noi_dung:ntext',
            'danh_muc',
            'trang_thai',
            'do_khan_cap',
            'user_id',
            'assigned_to',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
