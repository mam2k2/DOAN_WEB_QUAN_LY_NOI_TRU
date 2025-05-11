<?php

use backend\widgets\Bar;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\KhoaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Khoas';
$this->params['breadcrumbs'][] = yii::t('app', 'Quản lý khóa');
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
                        'ten_khoa',
                       [
                               'attribute' => 'created_at',
                           'format' => ['date', 'php:d-m-Y H:i:s'],
                       ],
                      [
                              'attribute' => 'updated_at',
                              'format' => ['date', 'php:d-m-Y H:i:s'],
                        ],

                        ['class' => ActionColumn::className(),],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
