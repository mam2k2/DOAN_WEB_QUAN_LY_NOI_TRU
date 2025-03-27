<?php

use backend\widgets\Bar;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = yii::t('app', 'Product');
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
                        'category_id',
                        'name',
                        'branch_id',
                        'price_import',
                        // 'price_export',
                        // 'tax_percentage',
                        // 'quantity',
                        // 'note',
                        // 'desc',
                        // 'type',
                        // 'SKU',
                        // 'unit',
                        // 'status',
                        // 'created_by',
                        // 'updated_by',
                        // 'deleted_by',
                        // 'created_at',
                        // 'updated_at',
                        // 'deleted_at',

                        ['class' => ActionColumn::className(),],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
