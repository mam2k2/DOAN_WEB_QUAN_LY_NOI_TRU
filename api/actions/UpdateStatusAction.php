<?php

namespace api\actions;

use Yii;
use Closure;
use backend\actions\helpers\Helper;
use yii\base\Exception;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\helpers\VarDumper;
use yii\rest\Action;
use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;

/**
 * Index list page
 *
 * Class IndexAction
 * @package backend\actions
 */
class UpdateStatusAction extends Action
{
    /**
     * @var string the scenario to be assigned to the model before it is validated and updated.
     */
    public $scenario = Model::SCENARIO_DEFAULT;
    /**
     * @var int stutus updated.
     */
    public $status;
    public $updateStatus;

    /**
     * Updates an existing model.
     * @param string $id the primary key of the model.
     * @return \yii\db\ActiveRecordInterface the model being updated
     * @throws ServerErrorHttpException if there is any error when updating the model
     */
    public function run($id)
    {
        $model = null;
        if ($this->updateStatus) {
            $model = call_user_func($this->updateStatus, $id);
        }else{
            /* @var $model ActiveRecord */
            $model = $this->findModel($id);

            if ($this->checkAccess) {
                call_user_func($this->checkAccess, $id, $model);
            }
            $model->scenario = $this->scenario;
            if(isset($model->status)){
                $model->status = $this->status;
            }else{
                throw new BadRequestHttpException('Yêu cầu không hợp lệ.');
            }
            if ($model->save() === false && !$model->hasErrors()) {
                throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
            }
        }
        $model = $this->findModel($id);
        if(is_null($model)){
            throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
        }
        return [
            "status"=> (is_bool($model)?$model: true),
            "message"=> Yii::t('app', 'Cập nhật trạng thái thành công'),
            "model"=>$this->findModel($id)
        ];
    }
}