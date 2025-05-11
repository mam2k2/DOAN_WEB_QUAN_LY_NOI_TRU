<?php

use backend\widgets\Bar;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\HocSinhSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Hoc Sinhs');
$this->params['breadcrumbs'][] = yii::t('app', 'Hoc Sinh');
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

                        'id' => [
                            'attribute' => 'id',
                            'label' => 'Id',
                            'filter' => false,
                        ],
                        'ho_va_ten',
                        'ngay_sinh' => [
                            'attribute' => 'ngay_sinh',
                            'format' => ['date', 'php:d-m-Y'],
                            'filter' => false,
                            'label' => 'Ngày sinh'
                        ],
                        'cccd',
                        'dia_chi',
                        'sdt_ca_nhan',
                        'sdt_gia_dinh',
                        'ten_day_du',
                        'que_quan',
                        [
                            'attribute' => 'trang_thai_text',
                            'label' => 'Trạng thái',
                        ],
                        'diem_trung_binh',
                        'ngay_bat_dau',
                        'ghi_chu',
                        ['class' => ActionColumn::className(),],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
