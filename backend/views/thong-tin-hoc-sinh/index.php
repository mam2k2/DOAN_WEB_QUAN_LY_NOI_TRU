<?php

use backend\widgets\Bar;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ThongTinHocSinhSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Thong Tin Hoc Sinhs');
$this->params['breadcrumbs'][] = yii::t('app', 'Thong Tin Hoc Sinh');
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
                        'user_id',
                        'lop_id',
                        'ngay_sinh',
                        'que_quan',
                        // 'trang_thai',
                        // 'diem_trung_binh',
                        // 'ngay_bat_dau',
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
