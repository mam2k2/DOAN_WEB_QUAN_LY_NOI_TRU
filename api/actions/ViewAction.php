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
class ViewAction extends \api\actions\Action
{
    /**
     * Displays a model.
     * @param string $id the primary key of the model.
     * @return \yii\db\ActiveRecordInterface the model being displayed
     */
    public $doFind;
    public $needGetPostData = false;
    public function run($id)
    {
        $postData = [];
        if($this->needGetPostData){
            $postData = $this->getDataPost();
            return call_user_func($this->doFind, $id,$postData);

        }
        if($this->doFind){
            return call_user_func($this->doFind, $id);
        }
        $model = $this->findModel($id);
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id, $model);
        }
        return $model;
    }

}