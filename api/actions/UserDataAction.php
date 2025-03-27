<?php

namespace api\actions;

use Yii;
use Closure;
use backend\actions\helpers\Helper;
use yii\base\Exception;
use yii\rest\Action;

/**
 * Index list page
 *
 * Class IndexAction
 * @package backend\actions
 */
class UserDataAction extends Action
{
    /**
     * Displays a model.
     * @param string $id the primary key of the model.
     * @return \yii\db\ActiveRecordInterface the model being displayed
     */
    public  $doFind;
    public function run()
    {

        $model = $this->findModel(\Yii::$app->user->id);
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id, $model);
        }
        if($this->doFind){
            return call_user_func($this->doFind,$model);
        }
        return $model;
    }

}