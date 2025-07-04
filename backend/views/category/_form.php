<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-03-21 14:35
 */

/**
 * @var $this yii\web\View
 * @var $model common\models\Category
 */

use backend\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\helpers\Util;

/**
 * @var $categories []
 */

$this->title = "Category";
$parent_id = Yii::$app->getRequest()->get('parent_id', '');
if ($parent_id != '') {
    $model->parent_id = $parent_id;
}
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?php $form = ActiveForm::begin(); ?>
                <?php
                $disabledOptions = [];
                if(!$model->getIsNewRecord()){
                    $disabledOptions[$model->id] = ['disabled' => true];
                    $descendants = $model->getDescendants($model->id);
                    $descendants = ArrayHelper::getColumn($descendants, 'id');
                    foreach ($descendants as $descendant){
                        $disabledOptions[$descendant] = ['disabled' => true];
                    }
                }
                ?>
                <?= $form->field($model, 'parent_id')
                    ->label(Yii::t('app', 'Parent Id'))
                    ->dropDownList($categories, ['options' => $disabledOptions]) ?>
                <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>
                <?= $form->field($model, 'alias')->textInput(['maxlength' => 64]) ?>
                <?= $form->field($model, 'sort')->textInput(['maxlength' => 512]) ?>
                <?= $form->defaultButtons() ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>