<?php

use backend\widgets\Bar;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ThuPhiNoiTruSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Thu Phi Noi Trus';
$this->params['breadcrumbs'][] = yii::t('app', 'Thu Phi Noi Tru');
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
                        'tenHocSinh',
//                        'khoan_phi_id',
                        'tenPhong',
                        'so_tien',
                         'ngay_thu',
//                         'nguoi_thu',
                         'trang_thai',
                         'ghi_chu:ntext',
                        // 'created_at',
                        // 'updated_at',

                        ['class' => ActionColumn::className(),],
                    ],
                ]); ?>
<?php Pjax::end(); ?>            </div>
        </div>
    </div>
</div>
