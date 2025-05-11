<?php

use backend\widgets\Bar;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ThietBiKtxSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Thiet Bi Ktxes');
$this->params['breadcrumbs'][] = yii::t('app', 'Thiet Bi Ktx');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?= Bar::widget() ?>
                <?=$this->render('_search', ['model' => $searchModel]); ?>
    <?php Pjax::begin(); ?>            <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => CheckboxColumn::className()],

                        'id',
                        'ma_thiet_bi',
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
                        'ten_thiet_bi',
                        'phong_o_id',
                        'tinh_trang',
                        // 'ngay_bao_tri',
                        // 'ghi_chu:ntext',
                        // 'created_at',
                        // 'updated_at',

                        ['class' => ActionColumn::className(),],
                    ],
                ]); ?>
<?php Pjax::end(); ?>            </div>
        </div>
    </div>
</div>
