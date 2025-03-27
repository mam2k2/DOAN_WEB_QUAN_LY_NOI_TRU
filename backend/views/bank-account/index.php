<?php

use backend\grid\StatusColumn;
use backend\widgets\Bar;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\BankAccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Bank Accounts');
$this->params['breadcrumbs'][] = yii::t('app', 'Bank Account');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?= Bar::widget() ?>
                <?= $this->render('_search', ['model' => $searchModel, 'userOptions' => $userOptions]); ?>
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
                        ],
                        [
                            'class' => StatusColumn::className(),
                            'attribute' => 'default',
                        ],
                        // 'created_by',
                        // 'updated_by',
                        // 'created_at',
                        // 'updated_at',
                
                        ['class' => ActionColumn::className(),
                        ],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>