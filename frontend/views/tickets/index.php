<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Danh sách yêu cầu KTX';
?>

<div class="student-request-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('➕ Gửi yêu cầu mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div style="overflow: auto">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'tieu_de',
                [
                    'attribute' => 'noi_dung',
                    'format' => 'ntext',
                    'contentOptions' => ['style' => 'max-width: 300px; white-space: normal;'],
                ],
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

//            'created_at',
//            'updated_at',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update}',
                    'buttons' => [
                        'update' => function ($url, $model) {
                            return $model->trang_thai === 'open'
                                ? Html::a('Sửa', ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-warning'])
                                : '';
                        },
                        'view' => function ($url, $model) {
                            return Html::a('Xem', ['view', 'id' => $model->id], ['class' => 'btn btn-sm btn-info']);
                        },
                    ],
                ],
            ],
        ]) ?>
    </div>
</div>
