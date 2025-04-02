<?php

use backend\widgets\Bar;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\LopSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Lops');
$this->params['breadcrumbs'][] = yii::t('app', 'Lop');
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
                        'khoa_id',
                        'chu_nghiem_id',
                        'ten_lop',
                        'ngay_bat_dau',
                        // 'ghi_chu:ntext',
                        // 'created_at',
                        // 'updated_at',

                        ['class' => ActionColumn::className(),],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
