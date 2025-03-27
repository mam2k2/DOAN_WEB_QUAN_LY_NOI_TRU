<?php

use backend\grid\MoneyColumn;
use backend\grid\NumberColumn;
use backend\grid\StatusColumn;
use backend\helpers\DataHelper;
use backend\widgets\Bar;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\grid\GridView;
use common\models\Order;
use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = yii::t('app', 'Order');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?= Bar::widget(['template' => '{refresh}']) ?>
                <?= $this->render('_search', ['model' => $searchModel,
                    'shopOptions' => $shopOptions,
                    'userOptions' => $userOptions,
                    'categoryOptions' => $categoryOptions,
                ]); ?>
                <?php Pjax::begin(); ?>            <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        ['class' => CheckboxColumn::className()],
                        [
                                'attribute' => 'code',
                            'width' => '5%',
                        ],
                        [
                            'attribute' => 'name',
                            'value' => function ($model) {
                                return $model->product ? DataHelper::getLinkDetailModal(Url::to(['/product/view-layer', 'id' => $model->product_id]), $model->product->name) : $model->name;
                            },
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'shop_id',
                            'value' => function ($model) {
                                return $model->shopName ?? null;
                            },
                        ],
                        [
                            'attribute' => 'user_id',
                            'value' => function ($model) {
                                return $model->user ? DataHelper::getLinkDetailModal(Url::to(['/user/view-layer', 'id' => $model->user_id]), $model->user->name) : null;
                            },
                            'format' => 'raw'
                        ],
                        [
                            'class' => NumberColumn::className(),
                            'attribute' => 'price',
                        ],
                        // 'image',
                        // 'shop_id',
                        // 'description:ntext',
                        // 'content:ntext',
                        [
                            'attribute' => 'status',
                            'value' => function ($model) {
                                return Order::getStatusColorItems($model->status);
                            },
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'type',
                            'value' => function ($model) {
                                return Order::getTypeColorItems($model->type);
                            },
                            'format' => 'raw',
                        ],
                        // 'purchase_expiration',
                        // 'sales_expiration',
                        // 'address:ntext',
                        [
                            'class' => StatusColumn::className(),
                            'attribute' => 'is_system',
                        ],

                        // 'created_by',
                        // 'updated_by',
                        // 'created_at',
                        // 'updated_at',

                        ['class' => ActionColumn::className(), 'template' => '{view-layer} {confirm-received}',
                            'buttons' => [
                                'confirm-received' => function ($url, $model, $key, $index, $gridView) {
                                    $data = [];
                                    if ($model->type !== Order::TYPE_RECEIVE || $model->status !== Order::STATUS_PENDING)
                                        return null;
                                    if ($model instanceof ActiveRecord) {
                                        $primaryKeys = $model->getPrimaryKey(true);
                                        $data = [];
                                        foreach ($primaryKeys as $key => $abandon) {
                                            $data[$key] = $model->$key;
                                        }
                                    }
                                    return Html::a('<i class="glyphicon glyphicon-check" aria-hidden="true"></i> ', $url, [
                                        'title' => Yii::t('app', 'Confirm received'),
                                        'data-confirm' => Yii::t('app', 'Are you sure the customer received this order?'),
                                        'data-method' => 'post',
                                        'data-params' => json_encode($data),
                                        'data-pjax' => '0',
                                        'class' => 'btn-sm',
                                    ]);
                                }
                            ]
                        ],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>            </div>
        </div>
    </div>
</div>
