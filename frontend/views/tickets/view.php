<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var $model app\models\StudentRequest */

$this->title = 'Chi tiết yêu cầu #' . $model->id;
?>

<div class="student-request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Quay lại danh sách', ['index'], ['class' => 'btn btn-secondary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tieu_de',
            'noi_dung:ntext',
            'danh_muc',
            [
                'attribute' => 'trang_thai',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->trang_thai !== "") {
                        return \common\models\Tickets::getTrangThaiTicketsArray()[$model->trang_thai];
                    }
                }
            ],
            [
                'attribute' => 'do_khan_cap',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->do_khan_cap !== "") {
                        return \common\models\Tickets::getRateTicketsArray()[$model->do_khan_cap];
                    }
                }
            ],
//            [
//                'attribute' => 'user_id',
//                'value' => $model->user->name ?? '(ẩn danh)'
//            ],
//            [
//                'attribute' => 'assigned_to',
//                'value' => $model->assignedTo->name ?? '(chưa xử lý)'
//            ],
//            'created_at',
//            'updated_at',
        ],
    ]) ?>

</div>
