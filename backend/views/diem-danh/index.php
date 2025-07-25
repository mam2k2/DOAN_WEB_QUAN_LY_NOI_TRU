<?php

use backend\widgets\Bar;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\DiemDanhSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Diem Danhs';
$this->params['breadcrumbs'][] = yii::t('app', 'Diem Danh');
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
                        [
                                'attribute' => 'hoc_sinh_id',
                                'value' => function ($model) {
                                    return $model->hocSinh->ho_va_ten;
                                }
                        ],
                        [
                                'attribute' => 'phong_id',
                            'label' => 'Tên phòng',
                            'value' => function ($model) {
                                return $model->phong->ten_phong ?? "";
                            }
                        ],
                        'ngay_diem_danh',
                        'thoi_gian',
                        // 'created_at',
                        // 'updated_at',

                        ['class' => ActionColumn::className(),],
                    ],
                ]); ?>
<?php Pjax::end(); ?>            </div>
        </div>
    </div>
</div>
