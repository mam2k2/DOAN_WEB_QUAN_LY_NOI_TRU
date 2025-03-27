<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2017-03-15 21:16
 */

namespace backend\widgets;

use Yii;

class ActiveForm extends \yii\widgets\ActiveForm
{

    public $options = [
        //'class' => 'form-horizontal'
    ];

    public $fieldClass = 'backend\widgets\ActiveField';


    /**
     * 生成表单确认和重置按钮
     *
     * @param array $options
     * @return string
     */

    public function defaultButtons(array $options = [])
    {
        $options['size'] = isset($options['size']) ? $options['size'] : 2;
        return '<div class="form-group">
                    <div class="col-sm-' . $options['size'] . ' col-sm-offset-5">
                        <button class="btn btn-primary" type="submit">' . Yii::t('app', 'Save') . '</button>
                        <button class="btn btn-white" type="reset">' . Yii::t('app', 'Reset') . '</button>
                    </div>
                </div>';
    }

    /**
     * Generates a form field.
     * @param $model
     * @param $attribute
     * @param array $options
     * @return ActiveField the created ActiveField object.
     * @see fieldConfig
     */
    public function field($model, $attribute, $options = [])
    {
        $activeField = parent::field($model, $attribute, $options);
        /** @var $activeField ActiveField */
        return $activeField;
    }

}
