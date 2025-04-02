<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\DiemMonHoc */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Diem Mon Hocs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diem-mon-hoc-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'mon_hoc_id:ntext',
            'user_id',
            'diem',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
