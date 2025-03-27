<?php

use backend\grid\StatusColumn;
use backend\widgets\Bar;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\grid\GridView;
use common\models\User;
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\BankAccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/** @var User $userModel */

$this->title = ($userModel->name ?? "") . " " . Yii::t('app', 'Bank Accounts');
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Users'), 'url' => Url::to(['index'])],
    ['label' => ($userModel->name ?? "") . " - " .yii::t('app', 'Bank Account')],
];
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?= Bar::widget([
                    'buttons' => [
                        'delete' => function () use ($userModel) {
                                            return Html::a('<i class="fa fa-trash-o"></i> ' . Yii::t('app', 'Delete'), Url::to(['delete-bank-account', 'userId' => $userModel->id]), [
                                                'title' => Yii::t('app', 'Delete'),
                                                'data-pjax' => '0',
                                                'data-confirm' => Yii::t('app', 'Really to delete?'),
                                                'class' => 'btn btn-white btn-sm multi-operate',
                                            ]);
                                        },
                        'create' => function () use ($userModel) {
                                            return Html::a('<i class="fa fa-plus"></i> ' . Yii::t('app', 'Create'), Url::to(['create-bank-account', 'userId' => $userModel->id]), [
                                                'title' => Yii::t('app', 'Create'),
                                                'data-pjax' => '0',
                                                'class' => 'btn btn-white btn-sm',
                                            ]);
                                        },
                    ]
                ]) ?>
                <?= $this->render('_search', ['model' => $searchModel, 'userModel' => $userModel]); ?>
                <?php Pjax::begin(); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        ['class' => CheckboxColumn::className()],
                        'name',
                        'bank_name',
                        'bank_number',
                        [
                            'attribute' => 'user_id',
                            'value' => function ($model) {
                                return $model->userName ?? null;
                            }
                        ],
                        [
                            'class' => StatusColumn::className(),
                            'attribute' => 'active',
                            'url' => function($model, $key, $index, $gridView) use($userModel){
                                return Url::to(['update-bank-account', 'userId' => $userModel->id,'id' => $model->id]);
                            }
                        ],
                        [
                            'class' => StatusColumn::className(),
                            'attribute' => 'default',
                            'url' => function($model, $key, $index, $gridView) use($userModel){
                                return Url::to(['update-bank-account', 'userId' => $userModel->id, 'id' => $model->id]);
                            }
                        ],
                        // 'created_by',
                        // 'updated_by',
                        // 'created_at',
                        // 'updated_at',
                
                        [
                            'class' => ActionColumn::className(),
                            'buttons' => [
                                'view-layer' => function ($url, $model, $key, $index, $gridView) {
                                    //$url = str_replace('viewLayer', 'view', $url);
                                    $url = Url::to(['/bank-account/view-layer', 'id' => $model->id]);
                                    return Html::a('<i class="fa fa-folder"></i> ', 'javascript:void(0)', [
                                        'title' => Yii::t('yii', 'View'),
                                        'url' => $url,
                                        'onclick' => "viewLayer('" . $url . "',$(this))",
                                        'data-pjax' => '0',
                                        'class' => 'btn-sm',
                                    ]);
                                },
                                'update' => function ($url, $model, $key, $index, $gridView) use($userModel) {
                                    return Html::a('<i class="fa fa-edit"></i> ', ['update-bank-account','userId' => $userModel->id, 'id' => $model->id], [
                                        'title' => Yii::t('app', 'Update'),
                                        'data-pjax' => '0',
                                        'class' => 'btn-sm',
                                    ]);
                                },
                                'delete' => function ($url, $model, $key, $index, $gridView) use($userModel) {
                                    $data = [];
                                    if($model instanceof ActiveRecord) {
                                        $primaryKeys = $model->getPrimaryKey(true);
                                        $data = [];
                                        foreach ($primaryKeys as $key => $abandon) {
                                            $data[$key] = $model->$key;
                                        }
                                    }
                                    return Html::a('<i class="glyphicon glyphicon-trash" aria-hidden="true"></i> ', ['delete-bank-account', 'userId' => $userModel->id, 'id' => $model->id], [
                                        'title' => Yii::t('app', 'Delete'),
                                        'data-confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                        'data-method' => 'post',
                                        'data-params' => json_encode($data),
                                        'data-pjax' => '0',
                                        'class' => 'btn-sm',
                                    ]);
                                },
                            ]
                        ],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>