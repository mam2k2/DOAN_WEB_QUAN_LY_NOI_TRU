<?php

use backend\widgets\Bar;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\PhongOSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $listKhu common\models\KhuKtx */


$this->title = Yii::t('app', 'Phong Os');
$this->params['breadcrumbs'][] = yii::t('app', 'Quản lý phòng ở');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?= Bar::widget() ?>
                <?=$this->render('_search', ['model' => $searchModel,'listKhu' => $listKhu,]); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => CheckboxColumn::className()],

                        'id',
                        [
                            'attribute' => 'ten_khu',
                            'label' => 'Tên Khu',
                        ],
                        [
                            'attribute' => 'hinh_anh',
                            'label' => 'Hình Ảnh',
                            'format' => 'raw',
                            'value' => function ($model) {
                                $imgId = 'img_' . $model->id;
                                $modalId = 'modal_' . $model->id;
                                return \yii\helpers\Html::a(
                                        \yii\helpers\Html::img($model->hinh_anh, ['style' => 'width: 100%; height: auto; cursor: pointer;']),
                                        'javascript:void(0)',
                                        [
                                            'title' => 'Xem ảnh',
                                            'data-pjax' => '0',
                                            'class' => 'btn-sm',
                                            //['thiet-bi-ktx/index', 'ThietBiKtxSearch[phong_o_id]' => $model->id]
                                            'onclick' => "viewLayer('$model->hinh_anh', $(this))",
                                        ]
                                    );

                            },
                            'contentOptions' => ['style' => 'width: 50px!important; text-align: center;'],
                        ],
                        'ma_phong',
                        'ten_phong',
                        [
                                'attribute' => 'phan_loai',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return $model->phan_loai == 0 ? "Nam" : "Nữ";
                                }

                        ],
                        [
                                'attribute' => 'suc_chua',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    if($model->suc_chua){
                                        return $model->so_luong_hien_tai."/".$model->suc_chua;
                                    }
                                }
                        ],
                        // 'so_luong_hien_tai',
                        // 'vi_tri',
                        // 'ghi_chu:ntext',
                        // 'created_at',
                        // 'updated_at',

                        [
                            'class' => ActionColumn::className(),
                            'template' => '{view} {update} {delete} {thietbi} {hocsinh}', // thêm tên nút
                            'buttons' => [
                                'view' => function ($url, $model, $key) {
                                    return \yii\helpers\Html::a('<i class="fa fa-folder"></i>', 'javascript:void(0)', [
                                        'class' => 'btn-sm',
                                        'title' => 'Xem thiết bị',
                                        'data-pjax' => '0',
                                        'onclick' => "viewLayer('/admin/index.php?r=phong-o/view-layer&id={$model->id}', $(this))",
                                    ]);
                                },
                                'thietbi' => function ($url, $model, $key) {
                                    return \yii\helpers\Html::a(
                                        '<i class="glyphicon glyphicon-barcode"></i>', "javascript:void(0)"// icon hoặc text
                                        , // đường dẫn
                                        [
                                            'title' => 'Danh sách thiết bị',
                                            'data-pjax' => '0',
                                            'class' => 'btn-sm',
                                            //['thiet-bi-ktx/index', 'ThietBiKtxSearch[phong_o_id]' => $model->id]
                                            'onclick' => "viewLayer('/admin/index.php?r=thiet-bi-ktx/index&ThietBiKtxSearch[phong_o_id]={$model->id}', $(this))",
                                        ]
                                    );
                                },
                                'hocsinh' => function ($url, $model, $key) {
                                    return \yii\helpers\Html::a(
                                        '<i class="glyphicon glyphicon-user"></i>', "javascript:void(0)"// icon hoặc text
                                        , // đường dẫn
                                        [
                                            'title' => 'Danh sách học sinh đang ở',
                                            'data-pjax' => '0',
                                            'class' => 'btn-sm',
                                            //['thiet-bi-ktx/index', 'ThietBiKtxSearch[phong_o_id]' => $model->id]
                                            'onclick' => "viewLayer('/admin/index.php?r=thong-tin-hoc-sinh/index&ThietBiKtxSearch[phong_o_id]={$model->id}', $(this))",
                                        ]
                                    );
                                },
                            ],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
