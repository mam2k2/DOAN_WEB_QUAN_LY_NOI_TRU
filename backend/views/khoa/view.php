<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Khoa */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Khoas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="khoa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ten_khoa',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
