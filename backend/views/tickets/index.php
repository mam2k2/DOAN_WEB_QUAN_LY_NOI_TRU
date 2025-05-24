<?php

use backend\widgets\Bar;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\TicketsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tickets';
$this->params['breadcrumbs'][] = yii::t('app', 'Tickets');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?= Bar::widget() ?>
                <?=$this->render('_search', ['model' => $searchModel]); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => CheckboxColumn::className()],

                        'id',
                        'tieu_de',
                        'noi_dung:ntext',
                        [
                    'attribute' => 'user_id',
                'format' => 'raw',
                'value' => function ($model) {
                    $User = \common\models\User::findOne($model->user_id);
                    return $User ? $User->username : "Ẩn danh";
                }
            ],
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
            [
                    'attribute' => 'created_at',
                'format' => 'datetime',

            ],

                        ['class' => ActionColumn::className(),],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
