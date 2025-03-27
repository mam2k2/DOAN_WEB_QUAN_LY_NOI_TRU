<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace api\actions;

use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;
use yii\web\ServerErrorHttpException;

/**
 * DeleteAction implements the API endpoint for deleting a model.
 *
 * For more details and usage information on DeleteAction, see the [guide article on rest controllers](guide:rest-controllers).
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DeleteAction extends \api\actions\Action
{
    public $onDelete;
    /**
     * Deletes a model.
     * @param mixed $id id of the model to be deleted.
     * @throws ServerErrorHttpException on failure.
     */
    public function run($id)
    {
        $result = null;
        if ($this->onDelete) {
            $result = call_user_func($this->onDelete, $id);
        }else{
            $model = $this->findModel($id);
            if ($this->checkAccess) {
                call_user_func($this->checkAccess, $this->id, $model);
            }
            if(isset($model->active)){
                $model->active = 0;
                if(!$model->save())
                    throw new ServerErrorHttpException("Không thể thực hiện thao tác này. Vui lòng liên hệ Admin để được hỗ trợ");
                $result = true;
            }
            else{
                throw new ServerErrorHttpException("Không thể thực hiện thao tác này. Vui lòng liên hệ Admin để được hỗ trợ");
            }
        }
        if ($result === true) {
            $response = Yii::$app->getResponse();
            Yii::$app->getResponse()->setStatusCode(204);
            if($this->doSuccess){
                return call_user_func($this->doSuccess, $result);
            }
            return  [
                'success'=>true,
                'message'=>"Tạo mới đối tượng thành công",
            ];
        } elseif (!$result->hasErrors()) {
            /**
             * @var $result Model
             */
            Yii::$app->response->statusCode = 500;
            return [
                'success'=>false,
                'message'=>"Lỗi hệ thống!",
            ];
        }
        if($this->doFail){
            return call_user_func($this->doFail, $result);
        }
    }
}
