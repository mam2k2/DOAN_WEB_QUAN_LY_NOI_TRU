<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2018-10-13 23:18
 */
use yii\helpers\Html;
use backend\widgets\ActiveForm;
use yii\helpers\Url;
use common\libs\Constants;

/* @var $this yii\web\View */
/* @var $model backend\models\search\ArticleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="test-search ibox-heading row search" style="margin-top: 5px;padding-top:5px">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'title', ['options'=>['class'=>'col-sm-3']]) ?>

    <?= $form->field($model, 'content', ['options'=>['class'=>'col-sm-3']])->label(Yii::t("app", "Content")) ?>

    <?= $form->field($model, 'sub_title', ['options'=>['class'=>'col-sm-3']]) ?>

    <?= $form->field($model, 'seo_keywords', ['options'=>['class'=>'col-sm-3']]) ?>

    <?= $form->field($model, 'visibility', ['options'=>['class'=>'col-sm-3']])->dropDownList(Constants::getYesNoItems()) ?>

    <?= $form->field($model, 'can_comment', ['options'=>['class'=>'col-sm-3']])->dropDownList(Constants::getYesNoItems()) ?>

    <?= $form->field($model, 'password', ['options'=>['class'=>'col-sm-3']])->dropDownList(Constants::getYesNoItems()) ?>

    <?= $form->field($model, 'summary', ['options'=>['class'=>'col-sm-3']]) ?>

    <?= $form->field($model, 'seo_title', ['options'=>['class'=>'col-sm-3']]) ?>

    <div class="col-sm-3">
        <div class="col-sm-6">
            <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary btn-block']) ?>
        </div>
        <div class="col-sm-6">
            <?= Html::a(Yii::t('app', 'Reset'), Url::to(['index']), ['class' => 'btn btn-default btn-block']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
