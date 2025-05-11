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
                        [
                            'attribute' => 'anh_chan_dung',
                            'label' => 'Ảnh chân dung',
                            'format' => 'raw',
                            'value' => function ($model) {
                                $imgId = 'img_' . $model->id;
                                $modalId = 'modal_' . $model->id;
                                return \yii\helpers\Html::a(
                                    \yii\helpers\Html::img($model->anh_chan_dung, ['style' => 'width: 66px; height: 100px; cursor: pointer;']),
                                    'javascript:void(0)',
                                    [
                                        'title' => 'Xem ảnh',
                                        'data-pjax' => '0',
                                        'class' => 'btn-sm',
                                        //['thiet-bi-ktx/index', 'ThietBiKtxSearch[phong_o_id]' => $model->id]
                                        'onclick' => "viewLayer('$model->anh_chan_dung', $(this))",
                                    ]
                                );

                            },
                            'contentOptions' => ['style' => 'width: 50px!important; text-align: center;'],
                        ],
                        'ho_va_ten',
                        'email:email',
                        [
                                'attribute' => 'ngay_sinh',
                                'format' => ['date', 'php:d-m-Y'],
                        ],
                        'que_quan',
                         [
                             'attribute' => 'trang_thai',
                             'label' => 'Trạng thái'
                         ],
                         'diem_trung_binh',
                        [
                            'attribute' => 'ngay_bat_dau',
                            'format' => ['date', 'php:d-m-Y'],
                        ],
                         'ghi_chu:ntext',
                        // 'created_at',
                        // 'updated_at',

                        ['class' => ActionColumn::className(),],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
